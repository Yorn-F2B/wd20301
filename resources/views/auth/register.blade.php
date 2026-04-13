<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
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
        <div class="auth-title">Tạo tài khoản</div>
        <div class="auth-sub">Đăng ký để bắt đầu mua sắm</div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Họ tên</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       placeholder="Nguyễn Văn A" value="{{ old('name') }}">
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       placeholder="email@example.com" value="{{ old('email') }}">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Mật khẩu</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       placeholder="Tối thiểu 6 ký tự">
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label">Xác nhận mật khẩu</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu">
            </div>
            <button type="submit" class="btn-main">Đăng ký</button>
        </form>

        <div class="divider">hoặc</div>
        <p class="text-center text-muted mb-0" style="font-size:.9rem">
            Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a>
        </p>
    </div>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
