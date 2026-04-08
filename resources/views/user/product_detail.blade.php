@extends('layouts.user')

@section('content')
<div class="row">
    <div class="col-md-5">
        @if($product->image)
            <img src="{{ Storage::url($product->image) }}" class="img-fluid rounded" style="max-height:400px;object-fit:cover;width:100%">
        @else
            <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
                 style="height:300px;color:#fff">Không có ảnh</div>
        @endif
    </div>
    <div class="col-md-7">
        <h3>{{ $product->name }}</h3>
        <p class="text-muted">Danh mục: {{ $product->category_name }}</p>
        <h4 class="text-danger">{{ number_format($product->price, 0, ',', '.') }} đ</h4>

        <div class="mt-4">
            @auth
                <form method="POST" action="{{ route('cart.add', $product->id) }}">
                    @csrf
                    <button class="btn btn-success btn-lg">🛒 Thêm vào giỏ hàng</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">
                    Đăng nhập để thêm vào giỏ hàng
                </a>
            @endauth
        </div>

        <a href="{{ route('home') }}" class="btn btn-link mt-3 ps-0">← Quay lại</a>
    </div>
</div>
@endsection
