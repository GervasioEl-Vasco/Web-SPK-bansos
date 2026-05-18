@extends('layouts.app')

@section('title', 'Detail Penduduk')
@section('page-title', 'Detail Penduduk')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold mb-0" style="font-size:1.4rem;color:#0f2347;">
        <i class="bi bi-person-lines-fill me-2 text-primary"></i> {{ $penduduk->nama }}
    </h1>
    <div class="d-flex gap-2">
        <a href="{{ route('penduduk.edit', $penduduk) }}" class="btn btn-warning btn-sm">
            <i class="bi bi-pencil me-1"></i> Edit
        </a>
        <a href="{{ route('penduduk.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header"><i class="bi bi-person-badge me-2"></i>Data Pribadi</div>
            <div class="card-body">
                <table class="table table-sm table-borderless mb-0">
                    <tr>
                        <td class="text-muted" style="width:40%; font-size:0.82rem;">NIK</td>
                        <td class="fw-semibold"><code>{{ $penduduk->nik }}</code></td>
                    </tr>
                    <tr>
                        <td class="text-muted" style="font-size:0.82rem;">Nama</td>
                        <td class="fw-semibold">{{ $penduduk->nama }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted" style="font-size:0.82rem;">Alamat</td>
                        <td>{{ $penduduk->alamat }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted" style="font-size:0.82rem;">Pekerjaan</td>
                        <td>{{ $penduduk->pekerjaan }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="card">
            <div class="card-header"><i class="bi bi-sliders me-2"></i>Data Kriteria SAW</div>
            <div class="card-body p-0">
                <table class="table table-sm mb-0">
                    <thead><tr>
                        <th class="px-3">Kode</th><th>Kriteria</th><th>Nilai Data</th><th>Rating</th>
                    </tr></thead>
                    <tbody style="font-size:0.83rem;">
                        <tr>
                            <td class="px-3"><code>C1</code></td>
                            <td>Penghasilan / Bulan</td>
                            <td>Rp {{ number_format($penduduk->penghasilan, 0, ',', '.') }}</td>
                            <td><span class="badge bg-secondary">{{ $penduduk->penghasilan <= 1000000 ? 1 : ($penduduk->penghasilan <= 3000000 ? 2 : ($penduduk->penghasilan <= 5000000 ? 3 : 4)) }}</span></td>
                        </tr>
                        <tr>
                            <td class="px-3"><code>C2</code></td>
                            <td>Jumlah Tanggungan</td>
                            <td>{{ $penduduk->tanggungan }} orang</td>
                            <td><span class="badge bg-secondary">{{ $penduduk->tanggungan <= 1 ? 1 : ($penduduk->tanggungan <= 2 ? 2 : ($penduduk->tanggungan <= 3 ? 3 : 4)) }}</span></td>
                        </tr>
                        <tr>
                            <td class="px-3"><code>C3</code></td>
                            <td>Kondisi Rumah</td>
                            <td>{{ $penduduk->kondisi_rumah_label }}</td>
                            <td><span class="badge bg-secondary">{{ $penduduk->kondisi_rumah }}</span></td>
                        </tr>
                        <tr>
                            <td class="px-3"><code>C4</code></td>
                            <td>Luas Bangunan</td>
                            <td>{{ $penduduk->luas_bangunan }} m²</td>
                            <td><span class="badge bg-secondary">{{ $penduduk->luas_bangunan < 30 ? 1 : ($penduduk->luas_bangunan <= 60 ? 2 : ($penduduk->luas_bangunan <= 90 ? 3 : 4)) }}</span></td>
                        </tr>
                        <tr>
                            <td class="px-3"><code>C5</code></td>
                            <td>Jenis Lantai</td>
                            <td>{{ $penduduk->jenis_lantai_label }}</td>
                            <td><span class="badge bg-secondary">{{ $penduduk->jenis_lantai }}</span></td>
                        </tr>
                        <tr>
                            <td class="px-3"><code>C6</code></td>
                            <td>Sumber Penerangan</td>
                            <td>{{ $penduduk->sumber_penerangan_label }}</td>
                            <td><span class="badge bg-secondary">{{ $penduduk->sumber_penerangan }}</span></td>
                        </tr>
                        <tr>
                            <td class="px-3"><code>C7</code></td>
                            <td>Kepemilikan Kendaraan</td>
                            <td>{{ $penduduk->kendaraan_label }}</td>
                            <td><span class="badge bg-secondary">{{ $penduduk->kendaraan }}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($penduduk->penilaians->isNotEmpty())
    <div class="col-12">
        <div class="card">
            <div class="card-header"><i class="bi bi-clipboard-data me-2"></i>Riwayat Penilaian</div>
            <div class="card-body p-0">
                <table class="table table-sm mb-0">
                    <thead><tr>
                        <th class="px-3">Periode</th><th>Nilai Akhir</th><th>Ranking</th><th>Status</th>
                    </tr></thead>
                    <tbody>
                        @foreach($penduduk->penilaians->sortByDesc('periode') as $p)
                        <tr>
                            <td class="px-3">{{ $p->periode }}</td>
                            <td><strong>{{ number_format($p->nilai_akhir, 6) }}</strong></td>
                            <td>
                                <span class="rank-badge {{ $p->ranking == 1 ? 'rank-1' : ($p->ranking == 2 ? 'rank-2' : ($p->ranking == 3 ? 'rank-3' : 'rank-other')) }}">
                                    {{ $p->ranking }}
                                </span>
                            </td>
                            <td>
                                @if($p->status == 'layak')
                                    <span class="badge badge-layak px-3">✓ Layak</span>
                                @else
                                    <span class="badge badge-tidak px-3">✗ Tidak Layak</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
