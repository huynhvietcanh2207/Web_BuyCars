@extends('admin')
@section('main')
<div class="container">
    <h1 class="h4 mb-4">Thêm người dùng</h1>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tên người dùng</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>

        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>

        <button type="submit" class="btn btn-success">Tạo người dùng</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
