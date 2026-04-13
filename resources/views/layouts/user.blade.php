<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f6fa; font-family: 'Segoe UI', sans-serif; }
        .navbar { background: #1a1a2e !important; border-bottom: 3px solid #e94560; }
        .navbar-brand { color: #fff !important; font-weight: 700; font-size: 1.3rem; letter-spacing: 1px; }
        .navbar-brand span { color: #e94560; }
        .nav-link { color: rgba(255,255,255,0.8) !important; font-size: 0.9rem; }
        .nav-link:hover, .nav-link.active { color: #fff !important; }
        .btn-accent { background: #e94560; color: #fff; border: none; }
        .btn-accent:hover { background: #c73652; color: #fff; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.07); transition: transform .2s, box-shadow .2s; }
        .card:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,0.12); }
        .card-img-top { border-radius: 12px 12px 0 0; }
        .price-tag { color: #e94560; font-weight: 700; font-size: 1.05rem; }
        .badge-cat { background: #f0f0f5; color: #555; font-size: 0.75rem; border-radius: 20px; padding: 3px 10px; }
        .alert-success { background: #e8f5e9; border: none; color: #2e7d32; border-radius: 10px; }
        footer { margin-top: 60px; padding: 20px 0; text-align: center; color: #aaa; font-size: 0.85rem; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">SHOP<span>.</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <div class="navbar-nav ms-auto align-items-center gap-1">
                @auth
                    @php
                        $cartCount = \Illuminate\Support\Facades\DB::table('carts')
                            ->where('user_id', Auth::id())->sum('quantity');
                    @endphp
                    <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                        Giỏ hàng
                        @if($cartCount > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill"
                                  style="background:#e94560;font-size:.65rem">{{ $cartCount }}</span>
                        @endif
                    </a>
                    @if(Auth::user()->role === 'admin')
                        <a class="nav-link" href="{{ route('admin.products.index') }}">Quản trị</a>
                    @endif
                    <span class="nav-link text-white-50">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-outline-light rounded-pill px-3">Đăng xuất</button>
                    </form>
                @else
                    <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="btn btn-accent btn-sm rounded-pill px-3">Đăng ký</a>
                @endauth
            </div>
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

<footer>© {{ date('Y') }} Shop. All rights reserved.</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
