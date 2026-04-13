@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0" style="font-weight:700;color:#1a1a2e">Quản lý danh mục</h5>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary px-4" style="border-radius:8px">+ Thêm danh mục</a>
</div>

<div class="card">
    <table class="table mb-0 align-middle">
        <thead>
            <tr>
                <th class="ps-4" style="width:60px">#</th>
                <th>Tên danh mục</th>
                <th>Ngày tạo</th>
                <th style="width:150px"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $cat)
            <tr>
                <td class="ps-4 text-muted">{{ $cat->id }}</td>
                <td style="font-weight:600">{{ $cat->name }}</td>
                <td class="text-muted" style="font-size:.85rem">{{ \Carbon\Carbon::parse($cat->created_at)->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', $cat->id) }}"
                       class="btn btn-sm btn-outline-primary me-1" style="border-radius:6px">Sửa</a>
                    <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Xóa danh mục này?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" style="border-radius:6px">Xóa</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center text-muted py-4">Chưa có danh mục nào.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
