@extends('layouts.app')

@section('title', 'Edit Bobot Kriteria')
@section('page-title', 'Edit Bobot Kriteria')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold mb-0" style="font-size:1.4rem;color:#0f2347;">
        <i class="bi bi-pencil-square me-2 text-primary"></i> Edit Bobot – {{ $kriteria->kode }}: {{ $kriteria->nama }}
    </h1>
    <a href="{{ route('kriteria.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('kriteria.update', $kriteria) }}">
                    @csrf @method('PUT')

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Kode</label>
                        <input type="text" class="form-control bg-light" value="{{ $kriteria->kode }}" disabled>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Nama Kriteria</label>
                        <input type="text" class="form-control bg-light" value="{{ $kriteria->nama }}" disabled>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Sifat</label>
                        <input type="text" class="form-control bg-light" value="{{ strtoupper($kriteria->sifat) }}" disabled>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Bobot (%)</label>
                        <div class="input-group">
                            <input type="number" name="bobot" class="form-control @error('bobot') is-invalid @enderror"
                                   value="{{ old('bobot', $kriteria->bobot) }}"
                                   step="0.01" min="0" max="1"
                                   placeholder="0.25 = 25%" required>
                            <span class="input-group-text" style="border-radius:0 10px 10px 0;">
                                = {{ number_format(old('bobot', $kriteria->bobot) * 100, 0) }}%
                            </span>
                            @error('bobot')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <small class="text-muted">Masukkan dalam desimal, misal 0.25 untuk 25%</small>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-save me-1"></i> Simpan Bobot
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
