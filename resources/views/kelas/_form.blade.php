<div class="form-group">
    <label for="nama_kelas">Nama Kelas</label>
    <input type="text" id="nama_kelas" name="nama_kelas"
        class="form-control @error('nama_kelas') is-invalid @enderror"
        value="{{ old('nama_kelas', $kelas->nama_kelas ?? '') }}" placeholder="Contoh: XI RPL 1" required>
    @error('nama_kelas')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        <label for="tingkat">Tingkat</label>
        <select id="tingkat" name="tingkat" class="form-control @error('tingkat') is-invalid @enderror" required>
            <option value="">-- Pilih Tingkat --</option>
            @foreach (['X', 'XI', 'XII'] as $t)
                <option value="{{ $t }}" {{ old('tingkat', $kelas->tingkat ?? '') == $t ? 'selected' : '' }}>
                    {{ $t }}</option>
            @endforeach
        </select>
        @error('tingkat')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="form-group col-md-8">
        <label for="jurusan">Jurusan</label>
        <input type="text" id="jurusan" name="jurusan"
            class="form-control @error('jurusan') is-invalid @enderror"
            value="{{ old('jurusan', $kelas->jurusan ?? '') }}" placeholder="Contoh: Rekayasa Perangkat Lunak" required>
        @error('jurusan')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="tahun_ajaran">Tahun Ajaran</label>
    <input type="text" id="tahun_ajaran" name="tahun_ajaran"
        class="form-control @error('tahun_ajaran') is-invalid @enderror"
        value="{{ old('tahun_ajaran', $kelas->tahun_ajaran ?? '') }}" placeholder="Contoh: 2025/2026" required>
    @error('tahun_ajaran')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>
