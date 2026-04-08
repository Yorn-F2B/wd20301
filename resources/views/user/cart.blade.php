@extends('layouts.user')

@section('content')
<h4 class="mb-3">Giỏ hàng của bạn</h4>

@if($items->isEmpty())
    <p class="text-muted">Giỏ hàng trống. <a href="{{ route('home') }}">Tiếp tục mua sắm</a></p>
@else
<table class="table table-bordered align-middle">
    <thead class="table-dark">
        <tr>
            <th>Ảnh</th>
            <th>Sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $item)
        <tr>
            <td>
                @if($item->image)
                    <img src="{{ Storage::url($item->image) }}" width="60" height="60" style="object-fit:cover;border-radius:4px">
                @else —
                @endif
            </td>
            <td>{{ $item->name }}</td>
            <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ</td>
            <td>
                <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4" class="text-end fw-bold">Tổng cộng:</td>
            <td colspan="2" class="fw-bold text-danger">{{ number_format($total, 0, ',', '.') }} đ</td>
        </tr>
    </tfoot>
</table>
<a href="{{ route('home') }}" class="btn btn-outline-primary">← Tiếp tục mua sắm</a>
@endif
@endsection
