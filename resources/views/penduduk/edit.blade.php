@extends('layouts.app')

@section('title', 'Edit Penduduk')
@section('page-title', 'Edit Data Penduduk')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold mb-0" style="font-size:1.4rem;color:#0f2347;">
        <i class="bi bi-pencil-square me-2 text-primary"></i> Edit: {{ $penduduk->nama }}
    </h1>
    <a href="{{ route('penduduk.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('penduduk.update', $penduduk) }}">
            @csrf @method('PUT')
            @include('penduduk._form')
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Update Data
                </button>
                <a href="{{ route('penduduk.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
