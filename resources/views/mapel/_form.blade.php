<div class="form-group">
    <label for="kode_mapel">Kode Mapel</label>
    <input type="text" id="kode_mapel" name="kode_mapel"
        class="form-control @error('kode_mapel') is-invalid @enderror"
        value="{{ old('kode_mapel', $mapel->kode_mapel ?? '') }}" placeholder="Contoh: MP-PWPB" required>
    @error('kode_mapel')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>

<div class="form-group">
    <label for="nama_mapel">Nama Mata Pelajaran</label>
    <input type="text" id="nama_mapel" name="nama_mapel"
        class="form-control @error('nama_mapel') is-invalid @enderror"
        value="{{ old('nama_mapel', $mapel->nama_mapel ?? '') }}" placeholder="Contoh: Basis Data" required>
    @error('nama_mapel')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>

<div class="form-group">
    <label for="kkm">KKM (Kriteria Ketuntasan Minimal)</label>
    <input type="number" id="kkm" name="kkm" min="0" max="100"
        class="form-control @error('kkm') is-invalid @enderror"
        value="{{ old('kkm', $mapel->kkm ?? 75) }}" required>
    @error('kkm')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>
