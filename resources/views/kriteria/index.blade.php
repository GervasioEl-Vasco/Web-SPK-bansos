@extends('layouts.app')

@section('title', 'Kriteria & Bobot')
@section('page-title', 'Kriteria & Bobot SAW')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold mb-0" style="font-size:1.4rem;color:#0f2347;">
        <i class="bi bi-sliders me-2 text-primary"></i> Manajemen Kriteria SAW
    </h1>
</div>

{{-- Total bobot info --}}
@php $totalBobot = $kriterias->sum('bobot'); @endphp
<div class="alert {{ abs($totalBobot - 1.0) < 0.001 ? 'alert-success' : 'alert-warning' }} d-flex align-items-center mb-3">
    <i class="bi bi-{{ abs($totalBobot - 1.0) < 0.001 ? 'check-circle-fill' : 'exclamation-triangle-fill' }} me-2 fs-5"></i>
    Total Bobot: <strong class="ms-1">{{ number_format($totalBobot * 100, 1) }}%</strong>
    @if(abs($totalBobot - 1.0) >= 0.001)
    — <span class="ms-1">Seharusnya 100%!</span>
    @else
    — <span class="ms-1">Valid ✓</span>
    @endif
</div>

<div class="row g-3">
    @foreach($kriterias as $k)
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>
                    <span class="badge me-2" style="background:var(--primary);font-size:0.8rem;">{{ $k->kode }}</span>
                    {{ $k->nama }}
                </span>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge {{ $k->sifat == 'benefit' ? '' : '' }}"
                          style="background:{{ $k->sifat == 'benefit' ? '#ecfdf5' : '#eff6ff' }};
                                 color:{{ $k->sifat == 'benefit' ? '#065f46' : '#1a3a6b' }};font-size:0.72rem;">
                        {{ strtoupper($k->sifat) }}
                    </span>
                    <strong style="color:var(--accent);font-size:1rem;">{{ number_format($k->bobot * 100, 0) }}%</strong>
                    <a href="{{ route('kriteria.edit', $k) }}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-pencil"></i>
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm mb-0">
                    <thead>
                        <tr><th class="px-3" style="width:30%;">Rating</th><th>Keterangan</th></tr>
                    </thead>
                    <tbody style="font-size:0.82rem;">
                        @foreach($k->subKriterias as $sub)
                        <tr>
                            <td class="px-3">
                                <span class="badge rounded-pill" style="background:#f1f5f9;color:#475569;">
                                    Nilai {{ $sub->nilai }}
                                </span>
                            </td>
                            <td>{{ $sub->keterangan }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
