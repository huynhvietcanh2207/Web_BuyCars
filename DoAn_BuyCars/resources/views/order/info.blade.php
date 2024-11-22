@extends('header_footer')

@section('main')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h1>Thông tin đơn hàng</h1>
        <p>Mã đơn hàng: <strong>{{ $order->order_code }}</strong></p>
        <p>Trạng thái: <strong>{{ $order->status }}</strong></p>
        <p>Ngày thanh toán: <strong>{{ $order->payment_date->format('d/m/Y H:i') }}</strong></p>
    </div>

    <div class="order-details">
        <h4>Sản phẩm:</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 0, ',', '.') }}₫</td>
                    <td>{{ number_format($item->quantity * $item->price, 0, ',', '.') }}₫</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="order-total text-end mt-4">
        <h4>Tổng tiền: <strong>{{ number_format($order->total, 0, ',', '.') }}₫</strong></h4>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('index') }}" class="btn btn-primary">Quay lại trang chủ</a>
    </div>
</div>
@endsection
    