@extends('admin')
@section('title', 'Phân Quyền Người Dùng')
@section('main')
<div class="container">
    <h1 class="h4 mb-4">Phân quyền cho người dùng</h1>
    <form action="{{ route('role.assign') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_id">Chọn người dùng</label>
            <select class="form-control" id="user_id" name="user_id" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="role_id">Chọn quyền</label>
            <select class="form-control" id="role_id" name="role_id" required>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->RoleName }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Phân quyền</button>
        <a href="{{ route('role.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection