@extends('admin')

@section('main')

<div class="container bg-white p-4 shadow">
    <h1 class="h4 mb-4">Chi tiết Đơn hàng #{{ $order->OrderId }}</h1>

    <p><strong>Ngày Đặt:</strong> {{ $order->OrderDate }}</p>
    <p><strong>Tổng Tiền:</strong> {{ $order->TotalAmount }}</p>
    <p><strong>Trạng Thái:</strong> {{ $order->OrderStatus }}</p>

    <h2 class="mt-4">Sản phẩm trong đơn hàng</h2>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form method="POST" action="{{ route('orders.update', $order->OrderId) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="OrderStatus">Trạng thái</label>
            <select name="OrderStatus" id="OrderStatus" class="form-control">
                <option value="pending" {{ $order->OrderStatus == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                <option value="completed" {{ $order->OrderStatus == 'completed' ? 'selected' : '' }}>Hoàn tất</option>
                <option value="cancelled" {{ $order->OrderStatus == 'cancelled' ? 'selected' : '' }}>Hủy</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Quay lại</a>

    </form>
</div>

@endsection
