@extends('layouts.app')

@section('title', 'Laporan Seleksi Bansos')
@section('page-title', 'Laporan Seleksi Bansos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold mb-0" style="font-size:1.4rem;color:#0f2347;">
        <i class="bi bi-file-earmark-pdf-fill me-2 text-danger"></i> Laporan Hasil Seleksi
    </h1>
    @if($hasilSeleksi->isNotEmpty())
    <a href="{{ route('laporan.cetak', ['periode' => $periode]) }}" class="btn btn-danger btn-sm" target="_blank">
        <i class="bi bi-download me-1"></i> Unduh PDF
    </a>
    @endif
</div>

{{-- Pilih Periode --}}
<div class="card mb-4">
    <div class="card-body py-2 px-3">
        <form method="GET" action="{{ route('laporan.index') }}" class="d-flex align-items-center gap-2">
            <label class="fw-semibold mb-0" style="font-size:0.85rem;">Pilih Periode:</label>
            <select name="periode" class="form-select form-select-sm" style="width:auto;">
                @forelse($periodes as $p)
                <option value="{{ $p }}" {{ $periode == $p ? 'selected' : '' }}>{{ $p }}</option>
                @empty
                <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                @endforelse
            </select>
            <button type="submit" class="btn btn-primary btn-sm">Tampilkan</button>
        </form>
    </div>
</div>

@if($hasilSeleksi->isNotEmpty())
{{-- Ringkasan --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card blue">
            <div class="stat-icon blue"><i class="bi bi-people-fill"></i></div>
            <div>
                <div class="stat-value">{{ $hasilSeleksi->count() }}</div>
                <div class="stat-label">Total Diseleksi</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card green">
            <div class="stat-icon green"><i class="bi bi-check-circle-fill"></i></div>
            <div>
                <div class="stat-value">{{ $totalLayak }}</div>
                <div class="stat-label">Penerima Layak</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card red">
            <div class="stat-icon red"><i class="bi bi-x-circle-fill"></i></div>
            <div>
                <div class="stat-value">{{ $totalTidakLayak }}</div>
                <div class="stat-label">Tidak Layak</div>
            </div>
        </div>
    </div>
</div>

{{-- Tabel Laporan --}}
<div class="card">
    <div class="card-header d-flex align-items-center">
        <i class="bi bi-table me-2"></i>
        Daftar Penerima Bantuan Sosial – Periode <strong class="ms-1">{{ $periode }}</strong>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="px-4">Ranking</th>
                        <th>NIK</th>
                        <th>Nama Penduduk</th>
                        <th>Alamat</th>
                        <th>Pekerjaan</th>
                        <th class="text-center">Nilai Akhir</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hasilSeleksi as $h)
                    <tr class="{{ $h->status == 'layak' ? '' : 'opacity-75' }}">
                        <td class="px-4">
                            <div class="rank-badge {{ $h->ranking == 1 ? 'rank-1' : ($h->ranking == 2 ? 'rank-2' : ($h->ranking == 3 ? 'rank-3' : 'rank-other')) }}">
                                {{ $h->ranking }}
                            </div>
                        </td>
                        <td><code style="font-size:0.78rem;">{{ $h->penduduk->nik }}</code></td>
                        <td class="fw-semibold">{{ $h->penduduk->nama }}</td>
                        <td style="font-size:0.82rem; max-width:200px;">{{ $h->penduduk->alamat }}</td>
                        <td style="font-size:0.85rem;">{{ $h->penduduk->pekerjaan }}</td>
                        <td class="text-center fw-bold" style="color:var(--primary);">
                            {{ number_format($h->nilai_akhir, 6) }}
                        </td>
                        <td class="text-center">
                            @if($h->status == 'layak')
                                <span class="badge badge-layak px-3 py-2">✓ Layak</span>
                            @else
                                <span class="badge badge-tidak px-3 py-2">✗ Tidak Layak</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-end">
        <a href="{{ route('laporan.cetak', ['periode' => $periode]) }}"
           class="btn btn-danger" target="_blank">
            <i class="bi bi-file-earmark-pdf-fill me-2"></i> Cetak Laporan PDF
        </a>
    </div>
</div>
@else
<div class="card">
    <div class="card-body text-center py-5 text-muted">
        <i class="bi bi-inbox fs-1 d-block mb-3" style="color:#cbd5e1;"></i>
        <h5 class="fw-semibold">Belum Ada Data Laporan</h5>
        <p>Silakan jalankan proses seleksi SAW terlebih dahulu.</p>
        @if(auth()->user()->isAdmin())
        <a href="{{ route('seleksi.index') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-cpu-fill me-1"></i> Ke Halaman Seleksi
        </a>
        @endif
    </div>
</div>
@endif
@endsection
