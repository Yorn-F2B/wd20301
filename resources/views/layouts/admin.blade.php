<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f6fa; font-family: 'Segoe UI', sans-serif; }
        .navbar { background: #1a1a2e !important; border-bottom: 3px solid #4f8ef7; }
        .navbar-brand { color: #fff !important; font-weight: 700; font-size: 1.2rem; letter-spacing: 1px; }
        .navbar-brand span { color: #4f8ef7; }
        .nav-link { color: rgba(255,255,255,0.75) !important; font-size: 0.9rem; }
        .nav-link:hover, .nav-link.active { color: #fff !important; }
        .nav-link.active { border-bottom: 2px solid #4f8ef7; }
        .sidebar-label { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; color: #aaa; margin: 16px 0 6px 0; }
        .table thead { background: #1a1a2e; color: #fff; }
        .table thead th { font-weight: 500; border: none; }
        .table tbody tr:hover { background: #f0f4ff; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.07); }
        .btn-primary { background: #4f8ef7; border-color: #4f8ef7; }
        .btn-primary:hover { background: #3a7ae0; border-color: #3a7ae0; }
        .alert-success { background: #e8f5e9; border: none; color: #2e7d32; border-radius: 10px; }
        .page-title { font-size: 1.4rem; font-weight: 700; color: #1a1a2e; margin-bottom: 1.2rem; }
        .badge-role { background: #e8f0fe; color: #4f8ef7; border-radius: 20px; padding: 3px 10px; font-size: 0.75rem; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('admin.products.index') }}">ADMIN<span>.</span></a>
        <div class="navbar-nav">
            <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}"
               href="{{ route('admin.products.index') }}">Sản phẩm</a>
            <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
               href="{{ route('admin.categories.index') }}">Danh mục</a>
        </div>
        <div class="navbar-nav ms-auto align-items-center gap-1">
            <a class="nav-link" href="{{ route('home') }}">Trang chủ</a>
            <span class="nav-link text-white-50">{{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button class="btn btn-sm btn-outline-light rounded-pill px-3">Đăng xuất</button>
            </form>
        </div>
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
