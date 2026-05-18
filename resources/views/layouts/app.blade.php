<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SPK Bantuan Sosial - Sistem Pendukung Keputusan Penerima Bantuan Sosial Metode SAW">
    <title>@yield('title', 'Dashboard') - SPK Bansos</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #1a3a6b;
            --primary-dark: #0f2347;
            --primary-light: #2d5ba3;
            --accent: #f0a500;
            --accent-light: #ffd166;
            --success: #06a77d;
            --danger: #e63946;
            --sidebar-width: 260px;
            --topbar-height: 64px;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: #f0f4f8;
            color: #2d3748;
            min-height: 100vh;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, var(--primary-dark) 0%, var(--primary) 60%, var(--primary-light) 100%);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            transition: transform 0.3s ease;
        }

        .sidebar-brand {
            padding: 1.5rem 1.25rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-brand .brand-icon {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
            margin-bottom: 0.6rem;
            box-shadow: 0 4px 15px rgba(240, 165, 0, 0.4);
        }

        .sidebar-brand h6 {
            color: #fff;
            font-weight: 700;
            font-size: 0.95rem;
            margin: 0;
            line-height: 1.3;
        }

        .sidebar-brand small {
            color: rgba(255,255,255,0.55);
            font-size: 0.72rem;
        }

        .sidebar-nav {
            padding: 1rem 0.75rem;
            flex: 1;
        }

        .nav-label {
            color: rgba(255,255,255,0.4);
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 0.5rem 0.75rem 0.25rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: rgba(255,255,255,0.75) !important;
            padding: 0.6rem 0.9rem;
            border-radius: 10px;
            margin-bottom: 2px;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .nav-link:hover {
            background: rgba(255,255,255,0.12);
            color: #fff !important;
            transform: translateX(3px);
        }

        .nav-link.active {
            background: linear-gradient(90deg, var(--accent), var(--accent-light));
            color: var(--primary-dark) !important;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(240, 165, 0, 0.35);
        }

        .nav-link i { font-size: 1.05rem; width: 20px; text-align: center; }

        .sidebar-footer {
            padding: 1rem 0.75rem 1.25rem;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem;
            border-radius: 10px;
            background: rgba(255,255,255,0.08);
        }

        .user-avatar {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--accent), #ff6b6b);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
            color: #fff;
            flex-shrink: 0;
        }

        .user-name { color: #fff; font-weight: 600; font-size: 0.8rem; }
        .user-role { color: rgba(255,255,255,0.5); font-size: 0.7rem; }

        /* ===== TOPBAR ===== */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--topbar-height);
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            z-index: 999;
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
        }

        .page-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary-dark);
        }

        .topbar-actions { display: flex; align-items: center; gap: 0.75rem; }

        .topbar-btn {
            width: 36px; height: 36px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            background: #fff;
            display: flex; align-items: center; justify-content: center;
            color: #64748b;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
        }
        .topbar-btn:hover { background: var(--primary); color: #fff; border-color: var(--primary); }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            margin-left: var(--sidebar-width);
            padding-top: var(--topbar-height);
            min-height: 100vh;
        }

        .content-area { padding: 1.75rem; }

        /* ===== CARDS ===== */
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover { box-shadow: 0 4px 20px rgba(0,0,0,0.1); }

        .card-header {
            background: none;
            border-bottom: 1px solid #f1f5f9;
            padding: 1.1rem 1.4rem;
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--primary-dark);
            border-radius: 16px 16px 0 0 !important;
        }

        /* ===== STAT CARDS ===== */
        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 1.4rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            border-left: 4px solid;
            transition: transform 0.2s;
        }
        .stat-card:hover { transform: translateY(-2px); }
        .stat-card.blue  { border-left-color: var(--primary); }
        .stat-card.green { border-left-color: var(--success); }
        .stat-card.amber { border-left-color: var(--accent); }
        .stat-card.red   { border-left-color: var(--danger); }

        .stat-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }
        .stat-icon.blue  { background: #eff6ff; color: var(--primary); }
        .stat-icon.green { background: #ecfdf5; color: var(--success); }
        .stat-icon.amber { background: #fffbeb; color: var(--accent); }
        .stat-icon.red   { background: #fef2f2; color: var(--danger); }

        .stat-value { font-size: 1.8rem; font-weight: 700; line-height: 1; color: var(--primary-dark); }
        .stat-label { font-size: 0.78rem; color: #94a3b8; font-weight: 500; margin-top: 2px; }

        /* ===== BADGES ===== */
        .badge-layak { background: #d1fae5; color: #065f46; font-weight: 600; }
        .badge-tidak { background: #fee2e2; color: #991b1b; font-weight: 600; }

        /* ===== TABLE ===== */
        .table th {
            background: #f8fafc;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            border-bottom: 1px solid #e2e8f0;
        }

        .table td { vertical-align: middle; font-size: 0.875rem; }
        .table-hover tbody tr:hover { background: #f8fafc; }

        /* ===== BUTTONS ===== */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border: none;
            font-weight: 600;
            padding: 0.55rem 1.2rem;
            border-radius: 10px;
            transition: all 0.2s;
        }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 4px 15px rgba(26,58,107,0.4); }

        .btn-warning {
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            border: none;
            color: var(--primary-dark) !important;
            font-weight: 600;
            border-radius: 10px;
        }

        .btn-sm { padding: 0.35rem 0.75rem; font-size: 0.8rem; border-radius: 8px; }

        /* ===== FORMS ===== */
        .form-control, .form-select {
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            font-size: 0.875rem;
            padding: 0.6rem 0.9rem;
            transition: all 0.2s;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(45,91,163,0.12);
        }

        /* ===== ALERTS ===== */
        .alert { border-radius: 12px; border: none; font-size: 0.875rem; }
        .alert-success { background: #d1fae5; color: #065f46; }
        .alert-danger  { background: #fee2e2; color: #991b1b; }
        .alert-warning { background: #fffbeb; color: #92400e; }

        /* ===== RANKING BADGE ===== */
        .rank-badge {
            width: 28px; height: 28px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.78rem;
            font-weight: 700;
        }
        .rank-1 { background: #ffd700; color: #7c5700; }
        .rank-2 { background: #c0c0c0; color: #444; }
        .rank-3 { background: #cd7f32; color: #fff; }
        .rank-other { background: #e2e8f0; color: #64748b; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .topbar, .main-content { left: 0; margin-left: 0; }
        }
    </style>

    @yield('styles')
</head>
<body>

{{-- ===== SIDEBAR ===== --}}
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">🏛️</div>
        <h6>SPK Bantuan Sosial</h6>
        <small>Metode SAW</small>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-label">Utama</div>
        <a href="{{ route('dashboard') }}"
           class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        @if(auth()->user()->isAdmin())
        <div class="nav-label mt-2">Data</div>
        <a href="{{ route('penduduk.index') }}"
           class="nav-link {{ request()->routeIs('penduduk.*') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i> Data Penduduk
        </a>
        <a href="{{ route('kriteria.index') }}"
           class="nav-link {{ request()->routeIs('kriteria.*') ? 'active' : '' }}">
            <i class="bi bi-sliders"></i> Kriteria & Bobot
        </a>

        <div class="nav-label mt-2">Proses</div>
        <a href="{{ route('seleksi.index') }}"
           class="nav-link {{ request()->routeIs('seleksi.*') ? 'active' : '' }}">
            <i class="bi bi-cpu-fill"></i> Proses Seleksi SAW
        </a>
        @endif

        <div class="nav-label mt-2">Laporan</div>
        <a href="{{ route('laporan.index') }}"
           class="nav-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-pdf-fill"></i> Laporan & Cetak
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="user-info mb-2">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-role">{{ ucfirst(auth()->user()->role) }}</div>
            </div>
        </div>
        <a href="{{ route('profil') }}"
           class="nav-link {{ request()->routeIs('profil') ? 'active' : '' }} mt-1">
            <i class="bi bi-person-gear"></i> Profil Saya
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link w-100 border-0 text-start"
                    style="background:none; color: rgba(255,100,100,0.85) !important;">
                <i class="bi bi-box-arrow-left"></i> Keluar
            </button>
        </form>
    </div>
</aside>

{{-- ===== TOPBAR ===== --}}
<div class="topbar">
    <div class="d-flex align-items-center gap-2">
        <button class="topbar-btn d-md-none" onclick="document.getElementById('sidebar').classList.toggle('show')">
            <i class="bi bi-list"></i>
        </button>
        <span class="page-title">@yield('page-title', 'Dashboard')</span>
    </div>
    <div class="topbar-actions">
        <span class="badge rounded-pill px-3 py-2"
              style="background:linear-gradient(135deg,var(--primary),var(--primary-light)); color:#fff; font-size:0.75rem;">
            <i class="bi bi-calendar3 me-1"></i> {{ now()->locale('id')->isoFormat('D MMMM Y') }}
        </span>
    </div>
</div>

{{-- ===== MAIN CONTENT ===== --}}
<main class="main-content">
    <div class="content-area">

        {{-- Alerts --}}
        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center mb-3" role="alert">
                <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger d-flex align-items-center mb-3" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                {{ session('error') }}
            </div>
        @endif

        @if(session('warning'))
            <div class="alert alert-warning d-flex align-items-center mb-3" role="alert">
                <i class="bi bi-exclamation-circle-fill me-2 fs-5"></i>
                {{ session('warning') }}
            </div>
        @endif

        @yield('content')
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
