@extends('layouts.app')

@section('title', 'Proses Seleksi SAW')
@section('page-title', 'Proses Seleksi SAW')

@section('styles')
<style>
.normalisasi-table { font-size: 0.75rem; }
.normalisasi-table th, .normalisasi-table td { white-space: nowrap; }
.step-badge {
    width: 28px; height: 28px;
    background: var(--primary);
    color: #fff;
    border-radius: 50%;
    display: inline-flex; align-items: center; justify-content: center;
    font-size: 0.8rem; font-weight: 700;
    flex-shrink: 0;
}
</style>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold mb-0" style="font-size:1.4rem;color:#0f2347;">
        <i class="bi bi-cpu-fill me-2 text-primary"></i> Proses Seleksi SAW
    </h1>
</div>

{{-- Form Proses --}}
<div class="card mb-4">
    <div class="card-header">
        <i class="bi bi-play-circle-fill me-2 text-success"></i> Jalankan Proses Seleksi
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('seleksi.proses') }}" class="row g-3 align-items-end">
            @csrf
            <div class="col-md-4">
                <label class="form-label fw-semibold">Periode (Tahun)</label>
                <select name="periode" class="form-select">
                    @foreach(range(date('Y'), date('Y') - 3) as $yr)
                    <option value="{{ $yr }}" {{ $periode == $yr ? 'selected' : '' }}>{{ $yr }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-auto">
                <button type="submit" class="btn btn-primary"
                        onclick="return confirm('Proses seleksi SAW untuk periode {{ $periode }}? Data seleksi sebelumnya akan dihapus.')">
                    <i class="bi bi-lightning-fill me-1"></i> Proses Sekarang
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Kriteria & Bobot Summary --}}
<div class="card mb-4">
    <div class="card-header"><i class="bi bi-sliders me-2"></i> Kriteria & Bobot Aktif</div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-sm mb-0">
                <thead>
                    <tr>
                        @foreach($kriterias as $k)
                        <th class="text-center">
                            {{ $k->kode }}<br>
                            <small class="fw-normal text-muted" style="font-size:0.68rem; white-space:nowrap;">{{ number_format($k->bobot * 100,0) }}% | {{ strtoupper($k->sifat) }}</small>
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach($kriterias as $k)
                        <td class="text-center fw-bold">{{ number_format($k->bobot, 4) }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($hasilSeleksi->isNotEmpty())
{{-- Tabel Matriks Normalisasi --}}
@if(!empty($detailNormalisasi) && isset($detailNormalisasi['matriksR']))
<div class="card mb-4">
    <div class="card-header d-flex align-items-center gap-2">
        <i class="bi bi-table me-1 text-primary"></i> Matriks Normalisasi (R)
        <small class="text-muted ms-auto">Cost: rij = min/xij | Benefit: rij = xij/max</small>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-sm normalisasi-table mb-0">
                <thead>
                    <tr>
                        <th class="px-3">Nama</th>
                        @foreach($kriterias as $k)<th class="text-center">{{ $k->kode }} (xij)</th>@endforeach
                        @foreach($kriterias as $k)<th class="text-center" style="background:#f0f9ff;">{{ $k->kode }} (rij)</th>@endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($detailNormalisasi['penduduks'] as $p)
                    <tr>
                        <td class="px-3 fw-semibold">{{ $p->nama }}</td>
                        @foreach($kriterias as $k)
                        <td class="text-center">{{ $detailNormalisasi['matriksX'][$p->id][$k->kode] ?? '-' }}</td>
                        @endforeach
                        @foreach($kriterias as $k)
                        <td class="text-center" style="background:#f0f9ff;">
                            {{ number_format($detailNormalisasi['matriksR'][$p->id][$k->kode] ?? 0, 4) }}
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

{{-- Hasil Ranking --}}
<div class="card">
    <div class="card-header d-flex align-items-center gap-2">
        <i class="bi bi-trophy-fill me-1" style="color:var(--accent)"></i>
        Hasil Ranking Seleksi – Periode {{ $periode }}
        <span class="badge ms-auto" style="background:#ecfdf5;color:#065f46;">
            {{ $hasilSeleksi->where('status','layak')->count() }} Layak
        </span>
        <span class="badge" style="background:#fee2e2;color:#991b1b;">
            {{ $hasilSeleksi->where('status','tidak_layak')->count() }} Tidak Layak
        </span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="px-4">Ranking</th>
                        <th>Nama Penduduk</th>
                        <th>NIK</th>
                        <th>Pekerjaan</th>
                        <th class="text-center">Nilai Akhir (Vi)</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hasilSeleksi as $h)
                    <tr>
                        <td class="px-4">
                            <div class="rank-badge {{ $h->ranking == 1 ? 'rank-1' : ($h->ranking == 2 ? 'rank-2' : ($h->ranking == 3 ? 'rank-3' : 'rank-other')) }}">
                                {{ $h->ranking }}
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('penduduk.show', $h->penduduk) }}" class="fw-semibold text-decoration-none">
                                {{ $h->penduduk->nama }}
                            </a>
                        </td>
                        <td><code style="font-size:0.78rem;">{{ $h->penduduk->nik }}</code></td>
                        <td style="font-size:0.85rem;">{{ $h->penduduk->pekerjaan }}</td>
                        <td class="text-center fw-bold" style="font-size:0.9rem; color:var(--primary);">
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
    <div class="card-footer d-flex justify-content-end gap-2">
        <a href="{{ route('laporan.index', ['periode' => $periode]) }}" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-eye me-1"></i> Lihat Laporan
        </a>
        <a href="{{ route('laporan.cetak', ['periode' => $periode]) }}" class="btn btn-danger btn-sm">
            <i class="bi bi-file-earmark-pdf me-1"></i> Unduh PDF
        </a>
    </div>
</div>
@else
<div class="card">
    <div class="card-body text-center py-5 text-muted">
        <i class="bi bi-cpu fs-1 d-block mb-3" style="color:#cbd5e1;"></i>
        <h5 class="fw-semibold">Belum Ada Hasil Seleksi</h5>
        <p class="mb-0">Klik tombol "Proses Sekarang" di atas untuk menjalankan algoritma SAW.</p>
    </div>
</div>
@endif
@endsection
