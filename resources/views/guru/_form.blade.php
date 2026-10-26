<div class="form-row">
    <div class="form-group col-md-4">
        <label for="nip">NIP</label>
        <input type="text" id="nip" name="nip" class="form-control @error('nip') is-invalid @enderror"
            value="{{ old('nip', $guru->nip ?? '') }}" required>
        @error('nip')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="form-group col-md-8">
        <label for="nama">Nama Lengkap</label>
        <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror"
            value="{{ old('nama', $guru->nama ?? '') }}" required>
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
            <option value="L" {{ old('jenis_kelamin', $guru->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-Laki</option>
            <option value="P" {{ old('jenis_kelamin', $guru->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
        </select>
        @error('jenis_kelamin')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="form-group col-md-4">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email', $guru->email ?? '') }}">
        @error('email')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="form-group col-md-4">
        <label for="no_hp">No HP</label>
        <input type="text" id="no_hp" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
            value="{{ old('no_hp', $guru->no_hp ?? '') }}">
        @error('no_hp')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="alamat">Alamat</label>
    <textarea id="alamat" name="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $guru->alamat ?? '') }}</textarea>
    @error('alamat')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>
