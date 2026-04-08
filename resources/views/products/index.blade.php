@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Sản phẩm</h4>
    <a href="{{ route('products.create') }}" class="btn btn-primary">+ Thêm sản phẩm</a>
</div>

<form method="GET" action="{{ route('products.index') }}" class="mb-3">
    <div class="input-group" style="max-width:400px">
        <input type="text" name="search" class="form-control" placeholder="Tìm theo tên sản phẩm..."
               value="{{ request('search') }}">
        <button class="btn btn-outline-secondary" type="submit">Tìm</button>
        @if(request('search'))
            <a href="{{ route('products.index') }}" class="btn btn-outline-danger">Xóa</a>
        @endif
    </div>
</form>

<table class="table table-bordered table-hover align-middle">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Danh mục</th>
            <th>Giá</th>
            <th style="width:160px">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>
                @if($product->image)
                    <img src="{{ Storage::url($product->image) }}" width="60" height="60"
                         style="object-fit:cover;border-radius:4px">
                @else
                    <span class="text-muted">—</span>
                @endif
            </td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category_name }}</td>
            <td>{{ number_format($product->price, 0, ',', '.') }} đ</td>
            <td>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Xóa sản phẩm này?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Xóa</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center text-muted">Chưa có sản phẩm nào.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
