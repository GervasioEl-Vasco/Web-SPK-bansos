@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('styles')
<style>
    .chart-container { position: relative; height: 220px; }
    .top-penerima-row { display: flex; align-items: center; gap: 0.75rem; padding: 0.6rem 0; border-bottom: 1px solid #f1f5f9; }
    .top-penerima-row:last-child { border-bottom: none; }
</style>
@endsection

@section('content')
{{-- Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="fw-bold mb-0" style="font-size:1.5rem; color:#0f2347;">Dashboard</h1>
        <p class="text-muted mb-0" style="font-size:0.85rem;">
            Selamat datang, <strong>{{ auth()->user()->name }}</strong> · Periode aktif: <strong>{{ $lastPeriode }}</strong>
        </p>
    </div>
    @if(auth()->user()->isAdmin())
    <a href="{{ route('seleksi.index') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-cpu-fill me-1"></i> Proses Seleksi
    </a>
    @endif
</div>

{{-- Stats Row --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="stat-card blue">
            <div class="stat-icon blue"><i class="bi bi-people-fill"></i></div>
            <div>
                <div class="stat-value">{{ $totalPenduduk }}</div>
                <div class="stat-label">Total Penduduk</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card green">
            <div class="stat-icon green"><i class="bi bi-check-circle-fill"></i></div>
            <div>
                <div class="stat-value">{{ $totalLayak }}</div>
                <div class="stat-label">Penerima Layak</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card red">
            <div class="stat-icon red"><i class="bi bi-x-circle-fill"></i></div>
            <div>
                <div class="stat-value">{{ $totalTidakLayak }}</div>
                <div class="stat-label">Tidak Layak</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card amber">
            <div class="stat-icon amber"><i class="bi bi-clipboard-check-fill"></i></div>
            <div>
                <div class="stat-value">{{ $sudahDiproses }}</div>
                <div class="stat-label">Sudah Diproses</div>
            </div>
        </div>
    </div>
</div>

{{-- Charts + Top Penerima --}}
<div class="row g-3 mb-4">
    {{-- Chart: Distribusi Kondisi Rumah --}}
    <div class="col-md-5">
        <div class="card h-100">
            <div class="card-header">
                <i class="bi bi-house-fill me-2 text-primary"></i> Distribusi Kondisi Rumah
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="chartKondisiRumah"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart: Distribusi Penghasilan --}}
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-header">
                <i class="bi bi-wallet2 me-2 text-primary"></i> Distribusi Penghasilan
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="chartPenghasilan"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Top 5 Penerima --}}
    <div class="col-md-3">
        <div class="card h-100">
            <div class="card-header">
                <i class="bi bi-trophy-fill me-2" style="color:var(--accent)"></i> Top 5 Penerima
            </div>
            <div class="card-body p-3">
                @forelse($topPenerima as $p)
                <div class="top-penerima-row">
                    <div class="rank-badge {{ $loop->index == 0 ? 'rank-1' : ($loop->index == 1 ? 'rank-2' : ($loop->index == 2 ? 'rank-3' : 'rank-other')) }}">
                        {{ $p->ranking }}
                    </div>
                    <div style="min-width:0; flex:1;">
                        <div class="fw-semibold text-truncate" style="font-size:0.82rem;">{{ $p->penduduk->nama }}</div>
                        <div class="text-muted" style="font-size:0.72rem;">{{ number_format($p->nilai_akhir, 4) }}</div>
                    </div>
                </div>
                @empty
                <div class="text-center text-muted py-3">
                    <i class="bi bi-inbox fs-2 d-block mb-1"></i>
                    <small>Belum ada seleksi</small>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- Info Cards --}}
<div class="row g-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-info-circle-fill me-2 text-primary"></i> Tentang Metode SAW
            </div>
            <div class="card-body" style="font-size:0.85rem; color:#475569; line-height:1.7;">
                <strong>Simple Additive Weighting (SAW)</strong> adalah metode pengambilan keputusan multi-kriteria
                yang bekerja dengan mencari penjumlahan terbobot dari rating kinerja pada setiap alternatif.
                Sistem ini menggunakan <strong>7 kriteria</strong> hasil kombinasi 3 jurnal ilmiah dengan
                normalisasi matriks keputusan menggunakan atribut <em>benefit</em> dan <em>cost</em>.
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-book-fill me-2 text-primary"></i> Referensi Jurnal
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush" style="font-size:0.78rem;">
                    <li class="list-group-item px-4 py-2">
                        <span class="badge" style="background:#eff6ff;color:#1a3a6b;margin-right:6px;">SAW</span>
                        Suprapto et al. (2024) — MALCOM Vol.4 Iss.1 (4 Kriteria)
                    </li>
                    <li class="list-group-item px-4 py-2">
                        <span class="badge" style="background:#ecfdf5;color:#065f46;margin-right:6px;">SAW</span>
                        Jurnal Dimamu (2025) — 10 Kriteria PMK Desa Cicalengka Wetan
                    </li>
                    <li class="list-group-item px-4 py-2">
                        <span class="badge" style="background:#fffbeb;color:#92400e;margin-right:6px;">Sistem</span>
                        Muhibah & Maryam (2021) — EMITTER Vol.21 No.2 (Arsitektur Web)
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
const colors = {
    blue:   'rgba(26, 58, 107, 0.8)',
    green:  'rgba(6, 167, 125, 0.8)',
    amber:  'rgba(240, 165, 0, 0.8)',
    red:    'rgba(230, 57, 70, 0.8)',
    light:  'rgba(45, 91, 163, 0.8)',
};

// Chart 1: Kondisi Rumah (Bar)
new Chart(document.getElementById('chartKondisiRumah'), {
    type: 'bar',
    data: {
        labels: ['Kontrak/Sewa', 'Bambu/Kayu', 'Plester', 'Keramik'],
        datasets: [{
            label: 'Jumlah KK',
            data: {!! json_encode($kondisiRumahData) !!},
            backgroundColor: [colors.red, colors.amber, colors.light, colors.green],
            borderRadius: 8,
            borderSkipped: false,
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f1f5f9' } },
            x: { grid: { display: false } }
        }
    }
});

// Chart 2: Penghasilan (Doughnut)
new Chart(document.getElementById('chartPenghasilan'), {
    type: 'doughnut',
    data: {
        labels: ['≤1 Juta', '1-3 Juta', '3-5 Juta', '>5 Juta'],
        datasets: [{
            data: {!! json_encode($penghasilanData) !!},
            backgroundColor: [colors.red, colors.amber, colors.light, colors.green],
            borderWidth: 2,
            borderColor: '#fff',
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: {
            legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } }
        },
        cutout: '65%',
    }
});
</script>
@endsection
