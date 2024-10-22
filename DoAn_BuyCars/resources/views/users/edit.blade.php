
    @extends('admin')
@section('main')
<div class="container">
    <h1 class="h4 mb-4">Chỉnh sửa người dùng</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="name">Email hiện tại</label>
     <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" readonly>
     <br>

    <label for="name">Nhập tên người dùng mới:</label>
    <input type="text" name="name" value="{{ old('name', $user->name) }}"> <br>
    <label for="name">Nhập mật khẩu mới:</label> 
    <input type="text" name="password" value="{{ old('password', $user->password) }}">
    <label for="name" value="{{ old('password', $user->password) }}" ></label> <br>
     <button type="submit">Update User</button>
</form>
</div>
@endsection
