@extends('admin')

@section('main')
<!-- Thông báo alert cho success -->
@if (session()->has('success'))
<script>
    window.onload = function() {
        alert("{{ session('success') }}");
    }
</script>
@endif

<!-- Thông báo alert cho error -->
@if (session()->has('error'))
<script>
    window.onload = function() {
        alert("{{ session('error') }}");
    }
</script>
@endif
<div class="container bg-white p-4 shadow">
    <h1 class="h4 mb-4">Danh sách Đơn hàng</h1>

    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Tạo Đơn Hàng</a>

    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Người Dùng</th>
                <th scope="col">Ngày Đặt</th>
                <th scope="col">Tổng Tiền</th>
                <th scope="col">Trạng Thái</th>
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->OrderId }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->OrderDate }}</td>

                <td>
                    @php
                    $totalAmount = 0;
                    foreach($order->orderItems as $item) {
                    $totalAmount += $item->quantity * $item->price;
                    }
                    @endphp
                    {{ number_format($totalAmount, 2) }}
                </td>

                <td>
                    @if($order->OrderStatus == 'pending')
                    Chờ xử lý
                    @elseif($order->OrderStatus == 'completed')
                    Hoàn thành
                    @elseif($order->OrderStatus == 'cancelled')
                    Đã hủy
                    @else
                    {{ $order->OrderStatus }}
                    @endif
                </td>
                <td>
                    <a href="{{ route('orders.show', $order->OrderId) }}" class="btn btn-info btn-sm">Xem</a>
                    <form action="{{ route('orders.destroy', $order->OrderId) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-3">
        {{ $orders->links() }}
    </div>
</div>

@endsection