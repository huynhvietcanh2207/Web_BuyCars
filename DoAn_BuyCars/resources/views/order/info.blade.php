@extends('header_footer')

@section('main')
<div class="container mt-5">
    <h1 class="text-center mb-4">Chi tiết đơn hàng</h1>

    <div class="order-details">
        <p><strong>Mã đơn hàng:</strong> {{ $order->order_code }}</p>
        <p><strong>Ngày thanh toán:</strong> {{ $order->payment_date->format('d/m/Y H:i') }}</p>
        <p><strong>Tổng tiền:</strong> {{ number_format($order->total, 0, ',', '.') }}₫</p>
        <p><strong>Trạng thái:</strong> {{ $order->status }}</p>

        <h3 class="mt-4">Chi tiết sản phẩm:</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 0, ',', '.') }}₫</td>
                        <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }}₫</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('order.history') }}" class="btn btn-primary">Quay lại lịch sử thanh toán</a>
    </div>
</div>
@endsection
