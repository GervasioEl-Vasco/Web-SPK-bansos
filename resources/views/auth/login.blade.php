<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SPK Bantuan Sosial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a3a6b;
            --primary-light: #2d5ba3;
            --accent: #f0a500;
        }
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #0f2347 0%, #1a3a6b 40%, #2d5ba3 100%);
            display: flex; align-items: center; justify-content: center;
            position: relative; overflow: hidden;
        }
        body::before {
            content: '';
            position: absolute; inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 1;
        }
        .login-container {
            width: 100%; max-width: 420px;
            position: relative; z-index: 10;
            padding: 1rem;
        }
        .login-card {
            background: rgba(255,255,255,0.97);
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: 0 25px 60px rgba(0,0,0,0.3);
            animation: slideUp 0.5s ease;
        }
        @keyframes slideUp {
            from { opacity:0; transform: translateY(30px); }
            to   { opacity:1; transform: translateY(0); }
        }
        .login-logo {
            width: 68px; height: 68px;
            background: linear-gradient(135deg, var(--accent), #ffd166);
            border-radius: 18px;
            display: flex; align-items: center; justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1.25rem;
            box-shadow: 0 8px 25px rgba(240, 165, 0, 0.4);
        }
        h4 { font-weight: 700; color: var(--primary); font-size: 1.35rem; }
        .subtitle { color: #94a3b8; font-size: 0.85rem; }
        .form-label { font-weight: 600; font-size: 0.82rem; color: #475569; }
        .form-control {
            border-radius: 12px;
            border: 1.5px solid #e2e8f0;
            padding: 0.7rem 1rem;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        .form-control:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(45,91,163,0.12);
        }
        .input-group-text {
            background: #f8fafc;
            border-radius: 12px 0 0 12px !important;
            border: 1.5px solid #e2e8f0;
            border-right: none;
            color: var(--primary-light);
        }
        .input-group .form-control {
            border-radius: 0 12px 12px 0 !important;
        }
        .btn-login {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border: none; color: #fff;
            padding: 0.75rem;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: 12px;
            width: 100%;
            transition: all 0.2s;
            letter-spacing: 0.3px;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(26,58,107,0.4);
            color: #fff;
        }
        .invalid-feedback { font-size: 0.78rem; }
        .form-check-label { font-size: 0.82rem; color: #64748b; }
        .login-footer { font-size: 0.75rem; color: #94a3b8; }
        .demo-accounts {
            background: #f8fafc;
            border-radius: 12px;
            padding: 0.9rem 1rem;
            margin-top: 1rem;
            border: 1px solid #e2e8f0;
        }
        .demo-accounts h6 { font-size: 0.78rem; font-weight: 600; color: #475569; margin-bottom: 0.4rem; }
        .demo-item { font-size: 0.75rem; color: #64748b; font-family: monospace; }
    </style>
</head>
<body>
<div class="login-container">
    <div class="text-center mb-3">
        <div class="d-flex align-items-center justify-content-center gap-2">
            <div style="width:6px;height:6px;border-radius:50%;background:rgba(255,255,255,0.5);"></div>
            <small style="color:rgba(255,255,255,0.7); font-size:0.75rem; letter-spacing:2px; text-transform:uppercase;">Sistem Pendukung Keputusan</small>
            <div style="width:6px;height:6px;border-radius:50%;background:rgba(255,255,255,0.5);"></div>
        </div>
    </div>

    <div class="login-card">
        <div class="login-logo">🏛️</div>
        <h4 class="text-center mb-1">SPK Bantuan Sosial</h4>
        <p class="subtitle text-center mb-4">Masuk ke sistem untuk melanjutkan</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                    <input type="email" name="email" id="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}"
                           placeholder="your@email.com" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" name="password" id="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="••••••••" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Ingat saya</label>
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i> Masuk
            </button>
        </form>

        <div class="demo-accounts mt-3">
            <h6><i class="bi bi-info-circle me-1"></i> Akun Demo</h6>
            <div class="demo-item"><b>Admin:</b> admin@spkbansos.id / admin123</div>
            <div class="demo-item"><b>Kades:</b> kades@spkbansos.id / kades123</div>
        </div>
    </div>

    <p class="text-center login-footer mt-3">
        © {{ date('Y') }} SPK Bantuan Sosial · Metode SAW
    </p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
