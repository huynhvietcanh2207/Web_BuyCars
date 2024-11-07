@extends('admin')
@section('main')
<div class="container">
    <h1 class="h4 mb-4">Chỉnh sửa người dùng</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="email">Email hiện tại</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $user->email) }}" readonly>
        </div>

        <div class="form-group">
            <label for="name">Nhập tên người dùng mới:</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label for="password">Nhập mật khẩu mới:</label>
            <input type="password" class="form-control" name="password" id="password">
            <small class="form-text text-muted">Để trống nếu không muốn thay đổi mật khẩu.</small>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật người dùng</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
