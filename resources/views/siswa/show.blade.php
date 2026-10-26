@extends('layouts.main')

@section('title', 'Detail Data Siswa')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-user-graduate mr-2 text-primary"></i>Detail Siswa</h1>
        <a href="{{ route('siswa.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Profil Siswa</h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <img class="img-profile rounded-circle" style="width: 90px; height: 90px;"
                            src="https://ui-avatars.com/api/?name={{ urlencode($siswa->nama) }}&background=4e73df&color=ffffff&size=180"
                            alt="{{ $siswa->nama }}">
                        <h5 class="mt-3 mb-0 font-weight-bold">{{ $siswa->nama }}</h5>
                        <span class="badge badge-secondary">{{ $siswa->nis }}</span>
                    </div>
                    <table class="table table-sm table-borderless mb-0">
                        <tr>
                            <th width="40%">Kelas</th>
                            <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ $siswa->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                        </tr>
                        <tr>
                            <th>No HP</th>
                            <td>{{ $siswa->no_hp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $siswa->alamat ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Riwayat Nilai Mata Pelajaran</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" width="100%" cellspacing="0">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Mata Pelajaran</th>
                                    <th class="text-center">Tugas</th>
                                    <th class="text-center">UTS</th>
                                    <th class="text-center">UAS</th>
                                    <th class="text-center">Nilai Akhir</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($siswa->nilais as $nilai)
                                    <tr>
                                        <td class="font-weight-bold">{{ $nilai->mapel->nama_mapel ?? '-' }}</td>
                                        <td class="text-center">{{ $nilai->nilai_tugas }}</td>
                                        <td class="text-center">{{ $nilai->nilai_uts }}</td>
                                        <td class="text-center">{{ $nilai->nilai_uas }}</td>
                                        <td class="text-center"><span class="badge badge-info p-2">{{ $nilai->nilai_akhir }}</span></td>
                                        <td class="text-center">
                                            <span class="badge badge-{{ $nilai->keterangan == 'Lulus' ? 'success' : 'danger' }} p-2">
                                                {{ $nilai->keterangan }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">Siswa ini belum memiliki data nilai.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
