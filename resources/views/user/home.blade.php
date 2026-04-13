@extends('layouts.user')

@section('content')

{{-- Search & Filter --}}
<form method="GET" action="{{ route('home') }}" class="mb-4">
    <div class="row g-2 align-items-center">
        <div class="col-md-5">
            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm sản phẩm..."
                   value="{{ request('search') }}" style="border-radius:8px;border:1.5px solid #e0e0e0;padding:10px 14px">
        </div>
        <div class="col-md-3">
            <select name="category" class="form-select" style="border-radius:8px;border:1.5px solid #e0e0e0;padding:10px 14px">
                <option value="">Tất cả danh mục</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <button class="btn px-4" style="background:#e94560;color:#fff;border-radius:8px;padding:10px 20px">Tìm</button>
        </div>
        @if(request('search') || request('category'))
        <div class="col-auto">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary" style="border-radius:8px">Xóa lọc</a>
        </div>
        @endif
    </div>
</form>

{{-- Products Grid --}}
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
    @forelse($products as $product)
    <div class="col">
        <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none">
            <div class="card h-100">
                @if($product->image)
                    <img src="{{ Storage::url($product->image) }}" class="card-img-top"
                         style="height:210px;object-fit:cover">
                @else
                    <div class="d-flex align-items-center justify-content-center bg-light"
                         style="height:210px;border-radius:12px 12px 0 0;color:#bbb;font-size:.9rem">
                        Không có ảnh
                    </div>
                @endif
                <div class="card-body pb-3">
                    <span class="badge-cat">{{ $product->category_name }}</span>
                    <h6 class="mt-2 mb-1 text-dark" style="font-size:.95rem;font-weight:600">{{ $product->name }}</h6>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <div class="price-tag">{{ number_format($product->price, 0, ',', '.') }} đ</div>
                        @auth
                            <form method="POST" action="{{ route('cart.add', $product->id) }}" onclick="event.stopPropagation()">
                                @csrf
                                <button type="submit" class="btn btn-sm"
                                        style="background:#e94560;color:#fff;border-radius:6px;font-size:.8rem;padding:4px 12px">
                                    + Giỏ
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </a>
    </div>
    @empty
    <div class="col-12">
        <div class="text-center py-5 text-muted">Không tìm thấy sản phẩm nào.</div>
    </div>
    @endforelse
</div>
@endsection
