<div class="form-row">
    <div class="form-group col-md-6">
        <label for="siswa_id">Pilih Siswa</label>
        <select id="siswa_id" name="siswa_id" class="form-control @error('siswa_id') is-invalid @enderror" required>
            <option value="">-- Pilih Siswa --</option>
            @foreach ($siswas as $s)
                <option value="{{ $s->id }}" {{ old('siswa_id', $nilai->siswa_id ?? '') == $s->id ? 'selected' : '' }}>
                    {{ $s->nis }} - {{ $s->nama }} ({{ $s->kelas->nama_kelas ?? '-' }})</option>
            @endforeach
        </select>
        @error('siswa_id')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="mapel_id">Pilih Mata Pelajaran</label>
        <select id="mapel_id" name="mapel_id" class="form-control @error('mapel_id') is-invalid @enderror" required>
            <option value="">-- Pilih Mata Pelajaran --</option>
            @foreach ($mapels as $m)
                <option value="{{ $m->id }}" data-kkm="{{ $m->kkm }}"
                    {{ old('mapel_id', $nilai->mapel_id ?? '') == $m->id ? 'selected' : '' }}>
                    {{ $m->nama_mapel }} (KKM {{ $m->kkm }})</option>
            @endforeach
        </select>
        @error('mapel_id')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        <label for="nilai_tugas">Nilai Tugas (30%)</label>
        <input type="number" step="0.01" min="0" max="100" id="nilai_tugas" name="nilai_tugas"
            class="form-control nilai-input @error('nilai_tugas') is-invalid @enderror"
            value="{{ old('nilai_tugas', $nilai->nilai_tugas ?? '') }}" required>
        @error('nilai_tugas')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="form-group col-md-4">
        <label for="nilai_uts">Nilai UTS (30%)</label>
        <input type="number" step="0.01" min="0" max="100" id="nilai_uts" name="nilai_uts"
            class="form-control nilai-input @error('nilai_uts') is-invalid @enderror"
            value="{{ old('nilai_uts', $nilai->nilai_uts ?? '') }}" required>
        @error('nilai_uts')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="form-group col-md-4">
        <label for="nilai_uas">Nilai UAS (40%)</label>
        <input type="number" step="0.01" min="0" max="100" id="nilai_uas" name="nilai_uas"
            class="form-control nilai-input @error('nilai_uas') is-invalid @enderror"
            value="{{ old('nilai_uas', $nilai->nilai_uas ?? '') }}" required>
        @error('nilai_uas')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="alert alert-info">
    <i class="fas fa-calculator mr-1"></i>
    Pratinjau nilai akhir: <strong id="previewAkhir">-</strong>
    <span id="previewStatus" class="badge badge-secondary ml-2"></span>
    <div class="small mt-1">Nilai akhir = (Tugas × 30%) + (UTS × 30%) + (UAS × 40%). Status ditentukan dari KKM mata pelajaran.</div>
</div>

@push('scripts')
    <script>
        (function () {
            var inputs = document.querySelectorAll('.nilai-input');
            var mapel = document.getElementById('mapel_id');
            var out = document.getElementById('previewAkhir');
            var status = document.getElementById('previewStatus');

            function hitung() {
                var t = parseFloat(document.getElementById('nilai_tugas').value);
                var u = parseFloat(document.getElementById('nilai_uts').value);
                var a = parseFloat(document.getElementById('nilai_uas').value);
                if (isNaN(t) || isNaN(u) || isNaN(a)) {
                    out.textContent = '-';
                    status.textContent = '';
                    return;
                }
                var akhir = Math.round(((t * 0.3) + (u * 0.3) + (a * 0.4)) * 100) / 100;
                out.textContent = akhir.toFixed(2);

                var opt = mapel.options[mapel.selectedIndex];
                var kkm = opt && opt.getAttribute('data-kkm');
                if (kkm === null || kkm === '' || typeof kkm === 'undefined') {
                    status.textContent = '';
                    return;
                }
                var lulus = akhir >= parseFloat(kkm);
                status.textContent = lulus ? 'Lulus' : 'Tidak Lulus';
                status.className = 'badge ml-2 badge-' + (lulus ? 'success' : 'danger');
            }

            inputs.forEach(function (el) { el.addEventListener('input', hitung); });
            mapel.addEventListener('change', hitung);
            hitung();
        })();
    </script>
@endpush
