{{-- Shared form partial for create & edit --}}
<div class="row g-3">
    {{-- Data Pribadi --}}
    <div class="col-12">
        <h6 class="fw-bold text-primary mb-2" style="font-size:0.85rem;letter-spacing:0.5px;text-transform:uppercase;">
            <i class="bi bi-person-badge me-1"></i> Data Pribadi
        </h6>
        <hr class="mt-0 mb-3">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">NIK <span class="text-danger">*</span></label>
        <input type="text" name="nik" id="nik"
               class="form-control @error('nik') is-invalid @enderror"
               value="{{ old('nik', $penduduk->nik ?? '') }}"
               maxlength="16" minlength="16" placeholder="16 digit NIK" required>
        @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-8">
        <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
        <input type="text" name="nama" id="nama"
               class="form-control @error('nama') is-invalid @enderror"
               value="{{ old('nama', $penduduk->nama ?? '') }}"
               placeholder="Nama sesuai KTP" required>
        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Pekerjaan <span class="text-danger">*</span></label>
        <input type="text" name="pekerjaan" id="pekerjaan"
               class="form-control @error('pekerjaan') is-invalid @enderror"
               value="{{ old('pekerjaan', $penduduk->pekerjaan ?? '') }}"
               placeholder="e.g. Buruh Harian" required>
        @error('pekerjaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Alamat <span class="text-danger">*</span></label>
        <input type="text" name="alamat" id="alamat"
               class="form-control @error('alamat') is-invalid @enderror"
               value="{{ old('alamat', $penduduk->alamat ?? '') }}"
               placeholder="Alamat lengkap" required>
        @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    {{-- Kriteria SAW --}}
    <div class="col-12 mt-3">
        <h6 class="fw-bold text-primary mb-2" style="font-size:0.85rem;letter-spacing:0.5px;text-transform:uppercase;">
            <i class="bi bi-sliders me-1"></i> Data Kriteria SAW
        </h6>
        <hr class="mt-0 mb-3">
    </div>

    {{-- C1: Penghasilan --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">
            C1 – Penghasilan per Bulan <span class="text-danger">*</span>
            <span class="badge ms-1" style="background:#eff6ff;color:#1a3a6b;font-size:0.7rem;">Cost</span>
        </label>
        <div class="input-group">
            <span class="input-group-text" style="border-radius:10px 0 0 10px;">Rp</span>
            <input type="number" name="penghasilan" id="penghasilan"
                   class="form-control @error('penghasilan') is-invalid @enderror"
                   value="{{ old('penghasilan', $penduduk->penghasilan ?? 0) }}"
                   min="0" placeholder="0" required
                   style="border-radius:0 10px 10px 0;">
            @error('penghasilan')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <small class="text-muted">≤1jt=1, 1-3jt=2, 3-5jt=3, >5jt=4</small>
    </div>

    {{-- C2: Tanggungan --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">
            C2 – Jumlah Tanggungan Keluarga <span class="text-danger">*</span>
            <span class="badge ms-1" style="background:#eff6ff;color:#1a3a6b;font-size:0.7rem;">Cost</span>
        </label>
        <input type="number" name="tanggungan" id="tanggungan"
               class="form-control @error('tanggungan') is-invalid @enderror"
               value="{{ old('tanggungan', $penduduk->tanggungan ?? 0) }}"
               min="0" max="20" placeholder="0" required>
        @error('tanggungan')<div class="invalid-feedback">{{ $message }}</div>@enderror
        <small class="text-muted">1 orang=1, 2 orang=2, 3 orang=3, ≥4=4</small>
    </div>

    {{-- C3: Kondisi Rumah --}}
    <div class="col-md-4">
        <label class="form-label fw-semibold">
            C3 – Kondisi Rumah <span class="text-danger">*</span>
            <span class="badge ms-1" style="background:#eff6ff;color:#1a3a6b;font-size:0.7rem;">Cost</span>
        </label>
        <select name="kondisi_rumah" id="kondisi_rumah" class="form-select @error('kondisi_rumah') is-invalid @enderror" required>
            <option value="1" {{ old('kondisi_rumah', $penduduk->kondisi_rumah ?? '') == 1 ? 'selected' : '' }}>1 – Kontrak/Sewa</option>
            <option value="2" {{ old('kondisi_rumah', $penduduk->kondisi_rumah ?? '') == 2 ? 'selected' : '' }}>2 – Bambu/Kayu</option>
            <option value="3" {{ old('kondisi_rumah', $penduduk->kondisi_rumah ?? '') == 3 ? 'selected' : '' }}>3 – Plester/Semi Permanen</option>
            <option value="4" {{ old('kondisi_rumah', $penduduk->kondisi_rumah ?? '') == 4 ? 'selected' : '' }}>4 – Tembok Keramik/Permanen</option>
        </select>
        @error('kondisi_rumah')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    {{-- C4: Luas Bangunan --}}
    <div class="col-md-4">
        <label class="form-label fw-semibold">
            C4 – Luas Bangunan (m²) <span class="text-danger">*</span>
            <span class="badge ms-1" style="background:#eff6ff;color:#1a3a6b;font-size:0.7rem;">Cost</span>
        </label>
        <div class="input-group">
            <input type="number" name="luas_bangunan" id="luas_bangunan"
                   class="form-control @error('luas_bangunan') is-invalid @enderror"
                   value="{{ old('luas_bangunan', $penduduk->luas_bangunan ?? 0) }}"
                   min="0" placeholder="0"
                   style="border-radius:10px 0 0 10px;" required>
            <span class="input-group-text" style="border-radius:0 10px 10px 0;">m²</span>
            @error('luas_bangunan')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <small class="text-muted"><30=1, 30-60=2, 61-90=3, >90=4</small>
    </div>

    {{-- C5: Jenis Lantai --}}
    <div class="col-md-4">
        <label class="form-label fw-semibold">
            C5 – Jenis Lantai <span class="text-danger">*</span>
            <span class="badge ms-1" style="background:#eff6ff;color:#1a3a6b;font-size:0.7rem;">Cost</span>
        </label>
        <select name="jenis_lantai" id="jenis_lantai" class="form-select @error('jenis_lantai') is-invalid @enderror" required>
            <option value="1" {{ old('jenis_lantai', $penduduk->jenis_lantai ?? '') == 1 ? 'selected' : '' }}>1 – Tanah</option>
            <option value="2" {{ old('jenis_lantai', $penduduk->jenis_lantai ?? '') == 2 ? 'selected' : '' }}>2 – Papan/Kayu</option>
            <option value="3" {{ old('jenis_lantai', $penduduk->jenis_lantai ?? '') == 3 ? 'selected' : '' }}>3 – Plester/Semen</option>
            <option value="4" {{ old('jenis_lantai', $penduduk->jenis_lantai ?? '') == 4 ? 'selected' : '' }}>4 – Keramik/Granit</option>
        </select>
        @error('jenis_lantai')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    {{-- C6: Sumber Penerangan --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">
            C6 – Sumber Penerangan <span class="text-danger">*</span>
            <span class="badge ms-1" style="background:#eff6ff;color:#1a3a6b;font-size:0.7rem;">Cost</span>
        </label>
        <select name="sumber_penerangan" id="sumber_penerangan" class="form-select @error('sumber_penerangan') is-invalid @enderror" required>
            <option value="1" {{ old('sumber_penerangan', $penduduk->sumber_penerangan ?? '') == 1 ? 'selected' : '' }}>1 – Tidak Ada Listrik</option>
            <option value="2" {{ old('sumber_penerangan', $penduduk->sumber_penerangan ?? '') == 2 ? 'selected' : '' }}>2 – PLN Tanpa Meteran</option>
            <option value="3" {{ old('sumber_penerangan', $penduduk->sumber_penerangan ?? '') == 3 ? 'selected' : '' }}>3 – PLN ≤450 VA</option>
            <option value="4" {{ old('sumber_penerangan', $penduduk->sumber_penerangan ?? '') == 4 ? 'selected' : '' }}>4 – PLN >450 VA</option>
        </select>
        @error('sumber_penerangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    {{-- C7: Kendaraan --}}
    <div class="col-md-6">
        <label class="form-label fw-semibold">
            C7 – Kepemilikan Kendaraan <span class="text-danger">*</span>
            <span class="badge ms-1" style="background:#eff6ff;color:#1a3a6b;font-size:0.7rem;">Cost</span>
        </label>
        <select name="kendaraan" id="kendaraan" class="form-select @error('kendaraan') is-invalid @enderror" required>
            <option value="1" {{ old('kendaraan', $penduduk->kendaraan ?? '') == 1 ? 'selected' : '' }}>1 – Tidak Punya</option>
            <option value="2" {{ old('kendaraan', $penduduk->kendaraan ?? '') == 2 ? 'selected' : '' }}>2 – Sepeda Motor</option>
            <option value="3" {{ old('kendaraan', $penduduk->kendaraan ?? '') == 3 ? 'selected' : '' }}>3 – Mobil</option>
            <option value="4" {{ old('kendaraan', $penduduk->kendaraan ?? '') == 4 ? 'selected' : '' }}>4 – Motor & Mobil</option>
        </select>
        @error('kendaraan')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
