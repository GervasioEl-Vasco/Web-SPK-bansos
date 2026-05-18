@extends('layouts.app')

@section('title', 'Tambah Penduduk')
@section('page-title', 'Tambah Data Penduduk')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold mb-0" style="font-size:1.4rem;color:#0f2347;">
        <i class="bi bi-person-plus-fill me-2 text-primary"></i> Tambah Penduduk
    </h1>
    <a href="{{ route('penduduk.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('penduduk.store') }}">
            @csrf
            @include('penduduk._form')
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Simpan Data
                </button>
                <a href="{{ route('penduduk.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
