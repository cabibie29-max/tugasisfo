<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MapelController extends Controller
{
    public function index()
    {
        $mapels = Mapel::orderBy('nama_mapel')->get();

        return view('mapel.index', compact('mapels'));
    }

    public function create()
    {
        return view('mapel.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        Mapel::create($data);

        return redirect()->route('mapel.index')->with('success', 'Data mata pelajaran berhasil ditambahkan.');
    }

    public function edit(Mapel $mapel)
    {
        return view('mapel.edit', compact('mapel'));
    }

    public function update(Request $request, Mapel $mapel)
    {
        $data = $this->validateData($request, $mapel);

        $mapel->update($data);

        return redirect()->route('mapel.index')->with('success', 'Data mata pelajaran berhasil diperbarui.');
    }

    public function destroy(Mapel $mapel)
    {
        try {
            $mapel->delete();
        } catch (QueryException $e) {
            return redirect()->route('mapel.index')
                ->with('error', 'Mata pelajaran tidak dapat dihapus karena sudah memiliki data nilai.');
        }

        return redirect()->route('mapel.index')->with('success', 'Data mata pelajaran berhasil dihapus.');
    }

    private function validateData(Request $request, ?Mapel $mapel = null): array
    {
        return $request->validate([
            'kode_mapel' => ['required', 'string', 'max:255', Rule::unique('mapels', 'kode_mapel')->ignore($mapel?->id)],
            'nama_mapel' => 'required|string|max:255',
            'kkm' => 'required|integer|min:0|max:100',
        ]);
    }
}
