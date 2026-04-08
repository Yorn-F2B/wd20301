@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Danh mục</h4>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">+ Thêm danh mục</a>
</div>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Tên danh mục</th>
            <th>Ngày tạo</th>
            <th style="width:160px">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $cat)
        <tr>
            <td>{{ $cat->id }}</td>
            <td>{{ $cat->name }}</td>
            <td>{{ $cat->created_at }}</td>
            <td>
                <a href="{{ route('categories.edit', $cat->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Xóa danh mục này?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Xóa</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="4" class="text-center text-muted">Chưa có danh mục nào.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
