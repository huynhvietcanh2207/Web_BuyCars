@extends('admin')
@section('title', 'Thêm Role Mới')
@section('main')
<div class="container">
    <h1 class="h4 mb-4">Thêm role mới</h1>
    <form action="{{ route('role.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Tên role</label>
            <input type="text" class="form-control" id="name" name="RoleName" required>
        </div>
        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea class="form-control" id="description" name="Description"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Thêm Role</button>
        <a href="{{ route('role.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection