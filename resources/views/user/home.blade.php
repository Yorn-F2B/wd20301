@extends('layouts.user')

@section('content')
<div class="row mb-3">
    <div class="col-md-8">
        <form method="GET" action="{{ route('home') }}" class="d-flex gap-2">
            <input type="text" name="search" class="form-control" placeholder="Tìm sản phẩm..."
                   value="{{ request('search') }}">
            <select name="category" class="form-select" style="max-width:180px">
                <option value="">Tất cả danh mục</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            <button class="btn btn-primary">Tìm</button>
            @if(request('search') || request('category'))
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">Xóa</a>
            @endif
        </form>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-4 g-4">
    @forelse($products as $product)
    <div class="col">
        <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none text-dark">
            <div class="card h-100 shadow-sm">
                @if($product->image)
                    <img src="{{ Storage::url($product->image) }}" class="card-img-top"
                         style="height:200px;object-fit:cover">
                @else
                    <div class="bg-secondary d-flex align-items-center justify-content-center"
                         style="height:200px;color:#fff">Không có ảnh</div>
                @endif
                <div class="card-body">
                    <h6 class="card-title">{{ $product->name }}</h6>
                    <p class="text-muted small mb-1">{{ $product->category_name }}</p>
                    <p class="fw-bold text-danger">{{ number_format($product->price, 0, ',', '.') }} đ</p>
                </div>
            </div>
        </a>
    </div>
    @empty
    <div class="col-12"><p class="text-muted">Không tìm thấy sản phẩm nào.</p></div>
    @endforelse
</div>
@endsection
