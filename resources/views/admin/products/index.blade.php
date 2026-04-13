@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0" style="font-weight:700;color:#1a1a2e">Quản lý sản phẩm</h5>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary px-4" style="border-radius:8px">+ Thêm sản phẩm</a>
</div>

<form method="GET" action="{{ route('admin.products.index') }}" class="mb-4">
    <div class="input-group" style="max-width:380px">
        <input type="text" name="search" class="form-control" placeholder="Tìm theo tên..."
               value="{{ request('search') }}" style="border-radius:8px 0 0 8px;border:1.5px solid #e0e0e0">
        <button class="btn btn-primary" style="border-radius:0 8px 8px 0">Tìm</button>
        @if(request('search'))
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary ms-2" style="border-radius:8px">Xóa</a>
        @endif
    </div>
</form>

<div class="card">
    <table class="table mb-0 align-middle">
        <thead>
            <tr>
                <th class="ps-4" style="width:50px">#</th>
                <th style="width:80px">Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Giá</th>
                <th style="width:150px"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $p)
            <tr>
                <td class="ps-4 text-muted">{{ $p->id }}</td>
                <td>
                    @if($p->image)
                        <img src="{{ Storage::url($p->image) }}" width="52" height="52"
                             style="object-fit:cover;border-radius:8px">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center"
                             style="width:52px;height:52px;border-radius:8px;color:#ccc;font-size:.7rem">N/A</div>
                    @endif
                </td>
                <td style="font-weight:600">{{ $p->name }}</td>
                <td><span class="badge-role">{{ $p->category_name }}</span></td>
                <td style="color:#e94560;font-weight:600">{{ number_format($p->price, 0, ',', '.') }} đ</td>
                <td>
                    <a href="{{ route('admin.products.edit', $p->id) }}"
                       class="btn btn-sm btn-outline-primary me-1" style="border-radius:6px">Sửa</a>
                    <form action="{{ route('admin.products.destroy', $p->id) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Xóa sản phẩm này?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" style="border-radius:6px">Xóa</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center text-muted py-4">Chưa có sản phẩm nào.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
