@extends('layouts.admin')

@section('content')
<div class="row justify-content-center">
<div class="col-md-7">
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('admin.products.index') }}" class="text-muted" style="text-decoration:none">&larr;</a>
        <h5 class="mb-0" style="font-weight:700;color:#1a1a2e">Sửa sản phẩm</h5>
    </div>
    <div class="card p-4">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-semibold">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $product->name) }}">
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Danh mục</label>
                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                    <option value="">-- Chọn danh mục --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Giá (đ)</label>
                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                       value="{{ old('price', $product->price) }}" min="0" step="1000">
                @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Ảnh sản phẩm</label>
                @if($product->image)
                    <div class="mb-2">
                        <img src="{{ Storage::url($product->image) }}" width="80" height="80"
                             style="object-fit:cover;border-radius:8px">
                        <small class="text-muted ms-2">Ảnh hiện tại</small>
                    </div>
                @endif
                <input type="file" name="image" class="form-control" accept="image/*">
                <small class="text-muted">Để trống nếu không muốn thay ảnh.</small>
                @error('image')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary px-4" style="border-radius:8px">Cập nhật</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary" style="border-radius:8px">Hủy</a>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
