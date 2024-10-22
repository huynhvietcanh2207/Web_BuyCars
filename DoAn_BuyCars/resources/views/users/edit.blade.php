
    @extends('admin')
@section('main')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">

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
 

     <button type="submit" class="btn btn-labeled btn-success">
         <span class="btn-label"><i class="fa fa-check"></i></span>Update User</button>



         <a href="{{ route('users.index') }}" class="btn btn-secondary">Quay lại</a>

</form>
</div>
@endsection
