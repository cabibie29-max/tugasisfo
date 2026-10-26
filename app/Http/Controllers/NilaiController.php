<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NilaiController extends Controller
{
    public function index()
    {
        $nilais = Nilai::with(['siswa.kelas', 'mapel'])->latest()->get();

        return view('nilai.index', compact('nilais'));
    }

    public function create()
    {
        $siswas = Siswa::with('kelas')->orderBy('nama')->get();
        $mapels = Mapel::orderBy('nama_mapel')->get();

        return view('nilai.create', compact('siswas', 'mapels'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        Nilai::create($this->hitung($data));

        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil ditambahkan.');
    }

    public function edit(Nilai $nilai)
    {
        $siswas = Siswa::with('kelas')->orderBy('nama')->get();
        $mapels = Mapel::orderBy('nama_mapel')->get();

        return view('nilai.edit', compact('nilai', 'siswas', 'mapels'));
    }

    public function update(Request $request, Nilai $nilai)
    {
        $data = $this->validateData($request, $nilai);

        $nilai->update($this->hitung($data));

        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil diperbarui.');
    }

    public function destroy(Nilai $nilai)
    {
        $nilai->delete();

        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil dihapus.');
    }

    private function validateData(Request $request, ?Nilai $nilai = null): array
    {
        return $request->validate([
            'siswa_id' => [
                'required',
                'exists:siswas,id',
                // Satu siswa hanya boleh punya satu nilai per mata pelajaran
                Rule::unique('nilais', 'siswa_id')
                    ->where('mapel_id', $request->input('mapel_id'))
                    ->ignore($nilai?->id),
            ],
            'mapel_id' => 'required|exists:mapels,id',
            'nilai_tugas' => 'required|numeric|min:0|max:100',
            'nilai_uts' => 'required|numeric|min:0|max:100',
            'nilai_uas' => 'required|numeric|min:0|max:100',
        ], [
            'siswa_id.unique' => 'Siswa ini sudah memiliki nilai untuk mata pelajaran tersebut.',
        ]);
    }

    /**
     * Hitung nilai akhir = (tugas*0.3) + (uts*0.3) + (uas*0.4)
     * dan tentukan keterangan berdasarkan KKM mata pelajaran.
     */
    private function hitung(array $data): array
    {
        $mapel = Mapel::findOrFail($data['mapel_id']);

        $nilaiAkhir = round(
            ($data['nilai_tugas'] * 0.3) + ($data['nilai_uts'] * 0.3) + ($data['nilai_uas'] * 0.4),
            2
        );

        $data['nilai_akhir'] = $nilaiAkhir;
        $data['keterangan'] = $nilaiAkhir >= $mapel->kkm ? 'Lulus' : 'Tidak Lulus';

        return $data;
    }
}
