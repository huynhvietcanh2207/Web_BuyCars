@extends('admin')
@section('title', 'Chỉnh sửa quyền: ' . $role->RoleName . '')
@section('main')
<div class="container">
    <h1 class="h4 mb-4">Sửa Role</h1>
    <form action="{{ route('role.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Tên Role</label>
            <input type="text" class="form-control" id="name" name="RoleName"
                value="{{ old('RoleName', $role->RoleName) }}" required>
        </div>
        <div class="form-group">
            <label for="description">Mô Tả</label>
            <textarea class="form-control" id="description"
                name="Description">{{ old('Description', $role->Description) }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Cập Nhật Role</button>
        <a href="{{ route('role.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection