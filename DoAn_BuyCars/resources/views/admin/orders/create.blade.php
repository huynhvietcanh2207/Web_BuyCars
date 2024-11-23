@extends('admin')

@section('main')

<div class="container bg-white p-4 shadow">
    <h1 class="h4 mb-4">Tạo Đơn Hàng Mới</h1>

    <form method="POST" action="{{ route('orders.store') }}">
        @csrf

        <div class="form-group">
            <label for="OrderDate">Ngày đặt hàng</label>
            <input type="date" name="OrderDate" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="OrderStatus">Trạng thái đơn hàng</label>
            <select name="OrderStatus" class="form-control" required>
                <option value="pending">Chờ xử lý</option>
                <option value="completed">Hoàn thành</option>
            </select>
        </div>

        <div class="form-group">
            <label for="user_id">Người dùng</label>
            <select name="user_id" class="form-control" required>
                <option value="">Chọn người dùng</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Lưu Đơn Hàng</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Quay lại</a>

    </form>
</div>

@endsection
