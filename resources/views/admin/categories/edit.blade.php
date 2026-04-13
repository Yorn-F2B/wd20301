@extends('layouts.admin')

@section('content')
<div class="row justify-content-center">
<div class="col-md-6">
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('admin.categories.index') }}" class="text-muted" style="text-decoration:none">&larr;</a>
        <h5 class="mb-0" style="font-weight:700;color:#1a1a2e">Sửa danh mục</h5>
    </div>
    <div class="card p-4">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-4">
                <label class="form-label fw-semibold">Tên danh mục</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $category->name) }}">
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary px-4" style="border-radius:8px">Cập nhật</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary" style="border-radius:8px">Hủy</a>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
