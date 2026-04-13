<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f6fa; font-family: 'Segoe UI', sans-serif; display: flex; align-items: center; min-height: 100vh; }
        .auth-card { background: #fff; border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,0.09); padding: 40px; max-width: 420px; width: 100%; }
        .auth-title { font-size: 1.6rem; font-weight: 700; color: #1a1a2e; margin-bottom: 6px; }
        .auth-sub { color: #888; font-size: 0.9rem; margin-bottom: 28px; }
        .form-control { border-radius: 8px; border: 1.5px solid #e0e0e0; padding: 10px 14px; }
        .form-control:focus { border-color: #e94560; box-shadow: 0 0 0 3px rgba(233,69,96,0.1); }
        .btn-main { background: #e94560; color: #fff; border: none; border-radius: 8px; padding: 11px; font-size: 1rem; width: 100%; }
        .btn-main:hover { background: #c73652; color: #fff; }
        .divider { text-align: center; color: #bbb; margin: 18px 0; font-size: 0.85rem; }
        a { color: #e94560; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="container">
<div class="row justify-content-center">
<div class="col-md-5">
    <div class="auth-card mx-auto">
        <div class="auth-title">Đăng nhập</div>
        <div class="auth-sub">Chào mừng bạn quay lại</div>

        @if(session('success'))
            <div class="alert alert-success mb-3">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-500">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       placeholder="email@example.com" value="{{ old('email') }}">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Mật khẩu</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••">
            </div>
            <div class="mb-4 form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label text-muted" for="remember">Ghi nhớ đăng nhập</label>
            </div>
            <button type="submit" class="btn-main">Đăng nhập</button>
        </form>

        <div class="divider">hoặc</div>
        <p class="text-center text-muted mb-0" style="font-size:.9rem">
            Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký ngay</a>
        </p>
    </div>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
