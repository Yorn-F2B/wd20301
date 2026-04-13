@extends('layouts.user')

@section('content')
<div class="row g-5">
    <div class="col-md-5">
        @if($product->image)
            <img src="{{ Storage::url($product->image) }}" class="img-fluid w-100"
                 style="border-radius:16px;max-height:420px;object-fit:cover">
        @else
            <div class="d-flex align-items-center justify-content-center bg-light"
                 style="height:360px;border-radius:16px;color:#bbb">Không có ảnh</div>
        @endif
    </div>
    <div class="col-md-7 d-flex flex-column justify-content-center">
        <span class="badge-cat mb-2 d-inline-block">{{ $product->category_name }}</span>
        <h2 style="font-weight:700;color:#1a1a2e">{{ $product->name }}</h2>
        <div class="price-tag mt-2 mb-4" style="font-size:1.6rem">
            {{ number_format($product->price, 0, ',', '.') }} đ
        </div>

        @auth
            <form method="POST" action="{{ route('cart.add', $product->id) }}">
                @csrf
                <button class="btn px-5 py-2"
                        style="background:#e94560;color:#fff;border-radius:10px;font-size:1rem;font-weight:600">
                    Thêm vào giỏ hàng
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-secondary px-5 py-2"
               style="border-radius:10px;font-size:1rem">
                Đăng nhập để mua hàng
            </a>
        @endauth

        <a href="{{ route('home') }}" class="mt-4 text-muted" style="font-size:.9rem;text-decoration:none">
            &larr; Quay lại cửa hàng
        </a>
    </div>
</div>
@endsection
