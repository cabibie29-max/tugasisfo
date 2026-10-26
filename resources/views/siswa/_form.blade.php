<div class="form-row">
    <div class="form-group col-md-4">
        <label for="nis">NIS</label>
        <input type="text" id="nis" name="nis" class="form-control @error('nis') is-invalid @enderror"
            value="{{ old('nis', $siswa->nis ?? '') }}" required>
        @error('nis')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="form-group col-md-8">
        <label for="nama">Nama Lengkap</label>
        <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror"
            value="{{ old('nama', $siswa->nama ?? '') }}" required>
        @error('nama')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        <label for="jenis_kelamin">Jenis Kelamin</label>
        <select id="jenis_kelamin" name="jenis_kelamin"
            class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
            <option value="">-- Pilih --</option>
            <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-Laki</option>
            <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
        </select>
        @error('jenis_kelamin')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="form-group col-md-4">
        <label for="kelas_id">Kelas</label>
        <select id="kelas_id" name="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror" required>
            <option value="">-- Pilih Kelas --</option>
            @foreach ($kelas as $k)
                <option value="{{ $k->id }}" {{ old('kelas_id', $siswa->kelas_id ?? '') == $k->id ? 'selected' : '' }}>
                    {{ $k->nama_kelas }}</option>
            @endforeach
        </select>
        @error('kelas_id')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="form-group col-md-4">
        <label for="no_hp">No HP</label>
        <input type="text" id="no_hp" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
            value="{{ old('no_hp', $siswa->no_hp ?? '') }}">
        @error('no_hp')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="alamat">Alamat</label>
    <textarea id="alamat" name="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $siswa->alamat ?? '') }}</textarea>
    @error('alamat')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>
