@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Sản phẩm</h4>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Thêm</a>
</div>

<form method="GET" action="{{ route('admin.products.index') }}" class="mb-3">
    <div class="input-group" style="max-width:400px">
        <input type="text" name="search" class="form-control" placeholder="Tìm sản phẩm..." value="{{ request('search') }}">
        <button class="btn btn-outline-secondary">Tìm</button>
        @if(request('search'))
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-danger">Xóa</a>
        @endif
    </div>
</form>

<table class="table table-bordered table-hover align-middle">
    <thead class="table-dark">
        <tr><th>#</th><th>Ảnh</th><th>Tên</th><th>Danh mục</th><th>Giá</th><th style="width:160px">Thao tác</th></tr>
    </thead>
    <tbody>
        @forelse($products as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>
                @if($p->image)
                    <img src="{{ Storage::url($p->image) }}" width="60" height="60" style="object-fit:cover;border-radius:4px">
                @else —
                @endif
            </td>
            <td>{{ $p->name }}</td>
            <td>{{ $p->category_name }}</td>
            <td>{{ number_format($p->price, 0, ',', '.') }} đ</td>
            <td>
                <a href="{{ route('admin.products.edit', $p->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                <form action="{{ route('admin.products.destroy', $p->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Xóa sản phẩm?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Xóa</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center text-muted">Chưa có sản phẩm.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
