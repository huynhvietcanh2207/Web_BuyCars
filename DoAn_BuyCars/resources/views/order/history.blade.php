@extends('header_footer')

@section('main')
<div class="container mt-5">
    <h1 class="text-center mb-4">Lịch sử thanh toán</h1>

    <!-- Tabs for Order Status -->
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link active" id="all-order-tab" data-bs-toggle="tab" href="#all-orders">Tất cả</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="summary-tab" data-bs-toggle="tab" href="#summary">Tóm tắt</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="complete-tab" data-bs-toggle="tab" href="#complete">Hoàn thành</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="canceled-tab" data-bs-toggle="tab" href="#canceled">Đã hủy</a>
        </li>
    </ul>

    <div class="tab-content">
        <!-- All Orders -->
        <div class="tab-pane active" id="all-orders">
            @foreach ($orders as $order)
                <div class="order-card mb-3 p-3 border rounded">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{ asset('images/' . $order->items->first()->product->image) }}" alt="Product Image" class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $order->items->first()->product->name }}</h5>
                            <p>By {{ $order->user->name }}</p>
                            <p><strong>Price:</strong> {{ number_format($order->total, 0, ',', '.') }}₫</p>
                        </div>
                        <div class="col-md-3 text-end">
                            <p>Status: 
                                @if($order->status == 'Delivered')
                                    <span class="text-success">Delivered</span>
                                @elseif($order->status == 'Canceled')
                                    <span class="text-danger">Canceled</span>
                                @else
                                    <span class="text-warning">Pending</span>
                                @endif
                            </p>
                            <p>Delivery Expected: {{ $order->payment_date->addDays(7)->format('d M Y') }}</p>
                            <a href="{{ route('order.info', ['id' => $order->id]) }}" class="btn btn-info btn-sm">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Summary Section -->
        <div class="tab-pane" id="summary">
            <p>Summary content goes here</p>
        </div>

        <!-- Complete Orders -->
        <div class="tab-pane" id="complete">
            @foreach ($orders->where('status', 'Delivered') as $order)
                <div class="order-card mb-3 p-3 border rounded">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{ asset('images/' . $order->items->first()->product->image) }}" alt="Product Image" class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $order->items->first()->product->name }}</h5>
                            <p>By {{ $order->user->name }}</p>
                            <p><strong>Price:</strong> {{ number_format($order->total, 0, ',', '.') }}₫</p>
                        </div>
                        <div class="col-md-3 text-end">
                            <p>Status: <span class="text-success">Delivered</span></p>
                            <p>Delivery Expected: {{ $order->payment_date->addDays(7)->format('d M Y') }}</p>
                            <a href="{{ route('order.info', ['id' => $order->id]) }}" class="btn btn-info btn-sm">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Canceled Orders -->
        <div class="tab-pane" id="canceled">
            @foreach ($orders->where('status', 'Canceled') as $order)
                <div class="order-card mb-3 p-3 border rounded">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{ asset('images/' . $order->items->first()->product->image) }}" alt="Product Image" class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $order->items->first()->product->name }}</h5>
                            <p>By {{ $order->user->name }}</p>
                            <p><strong>Price:</strong> {{ number_format($order->total, 0, ',', '.') }}₫</p>
                        </div>
                        <div class="col-md-3 text-end">
                            <p>Status: <span class="text-danger">Canceled</span></p>
                            <p>Delivery Expected: {{ $order->payment_date->addDays(7)->format('d M Y') }}</p>
                            <a href="{{ route('order.info', ['id' => $order->id]) }}" class="btn btn-info btn-sm">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
