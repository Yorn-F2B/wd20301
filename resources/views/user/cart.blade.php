@extends('layouts.user')

@section('content')
<h4 class="mb-4" style="font-weight:700;color:#1a1a2e">Giỏ hàng</h4>

@if($items->isEmpty())
    <div class="text-center py-5">
        <div style="font-size:3rem;color:#ddd">&#128722;</div>
        <p class="text-muted mt-2">Giỏ hàng của bạn đang trống.</p>
        <a href="{{ route('home') }}" class="btn px-4 mt-2"
           style="background:#e94560;color:#fff;border-radius:8px">Tiếp tục mua sắm</a>
    </div>
@else
<div class="card p-0">
    <table class="table mb-0 align-middle">
        <thead style="background:#1a1a2e;color:#fff">
            <tr>
                <th class="ps-4">Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td class="ps-4">
                    <div class="d-flex align-items-center gap-3">
                        @if($item->image)
                            <img src="{{ Storage::url($item->image) }}" width="56" height="56"
                                 style="object-fit:cover;border-radius:8px">
                        @endif
                        <span style="font-weight:600">{{ $item->name }}</span>
                    </div>
                </td>
                <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <form method="POST" action="{{ route('cart.decrease', $item->id) }}">
                            @csrf
                            <button class="btn btn-sm btn-outline-secondary" style="width:30px;height:30px;padding:0;border-radius:6px">−</button>
                        </form>
                        <span style="min-width:24px;text-align:center;font-weight:600">{{ $item->quantity }}</span>
                        <form method="POST" action="{{ route('cart.increase', $item->id) }}">
                            @csrf
                            <button class="btn btn-sm btn-outline-secondary" style="width:30px;height:30px;padding:0;border-radius:6px">+</button>
                        </form>
                    </div>
                </td>
                <td style="color:#e94560;font-weight:700">
                    {{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ
                </td>
                <td>
                    <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" style="border-radius:6px">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-between align-items-center mt-4">
    <a href="{{ route('home') }}" class="btn btn-outline-secondary" style="border-radius:8px">
        &larr; Tiếp tục mua sắm
    </a>
    <div class="text-end">
        <span class="text-muted me-3">Tổng cộng:</span>
        <span style="font-size:1.4rem;font-weight:700;color:#e94560">
            {{ number_format($total, 0, ',', '.') }} đ
        </span>
    </div>
</div>
@endif
@endsection
