@extends('layouts.app')

@section('title', 'Data Penduduk')
@section('page-title', 'Data Penduduk')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold mb-0" style="font-size:1.4rem;color:#0f2347;">
        <i class="bi bi-people-fill me-2 text-primary"></i> Data Penduduk
    </h1>
    <a href="{{ route('penduduk.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i> Tambah Penduduk
    </a>
</div>

{{-- Search --}}
<div class="card mb-3">
    <div class="card-body py-2 px-3">
        <form method="GET" action="{{ route('penduduk.index') }}" class="d-flex gap-2">
            <input type="text" name="search" class="form-control form-control-sm"
                   placeholder="Cari nama, NIK, atau alamat..."
                   value="{{ request('search') }}" style="max-width:300px;">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="bi bi-search"></i>
            </button>
            @if(request('search'))
            <a href="{{ route('penduduk.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
            @endif
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="px-4">No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Pekerjaan</th>
                        <th>Penghasilan</th>
                        <th>Tanggungan</th>
                        <th>Kondisi Rumah</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penduduks as $p)
                    <tr>
                        <td class="px-4">{{ $penduduks->firstItem() + $loop->index }}</td>
                        <td><code style="font-size:0.78rem;">{{ $p->nik }}</code></td>
                        <td>
                            <div class="fw-semibold" style="font-size:0.875rem;">{{ $p->nama }}</div>
                            <div class="text-muted" style="font-size:0.72rem;">{{ $p->alamat }}</div>
                        </td>
                        <td>{{ $p->pekerjaan }}</td>
                        <td>Rp {{ number_format($p->penghasilan, 0, ',', '.') }}</td>
                        <td><span class="badge bg-secondary">{{ $p->tanggungan }} orang</span></td>
                        <td>
                            <span class="badge rounded-pill px-2 py-1"
                                style="font-size:0.72rem;
                                background: {{ $p->kondisi_rumah == 1 ? '#fee2e2' : ($p->kondisi_rumah == 2 ? '#fffbeb' : ($p->kondisi_rumah == 3 ? '#eff6ff' : '#ecfdf5')) }};
                                color: {{ $p->kondisi_rumah == 1 ? '#991b1b' : ($p->kondisi_rumah == 2 ? '#92400e' : ($p->kondisi_rumah == 3 ? '#1a3a6b' : '#065f46')) }};">
                                {{ $p->kondisi_rumah_label }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('penduduk.show', $p) }}" class="btn btn-outline-secondary btn-sm me-1" title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('penduduk.edit', $p) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="POST" action="{{ route('penduduk.destroy', $p) }}" class="d-inline"
                                  onsubmit="return confirm('Hapus data {{ $p->nama }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            Tidak ada data penduduk ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($penduduks->hasPages())
        <div class="d-flex justify-content-between align-items-center px-4 py-3 border-top">
            <small class="text-muted">
                Menampilkan {{ $penduduks->firstItem() }}–{{ $penduduks->lastItem() }}
                dari {{ $penduduks->total() }} data
            </small>
            {{ $penduduks->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</div>
@endsection
