@extends('admin')
@section('main')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Người dùng</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="bg-light">
    <!-- @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif -->

    <div class="container bg-white p-4  shadow">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h4">Quản lý Người dùng</h1>

            <a href="{{ route('users.create') }}">Create New User</a>        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <button class="btn btn-danger d-flex align-items-center">
                <i class="fas fa-trash-alt mr-2"></i> Xóa các mục đã chọn
            </button>
        </div>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Tên người dùng</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Action</th>
                     
                </tr>
            </thead>

            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->password }}</td>
                     <td>  
                        
                        <a href="{{ route('users.edit', $user->id) }}"><i class="fa fa-pen"></i></a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-labeled btn-danger">
                         <span class="btn-label"><i class="fa fa-remove"></i></span></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

        </table>
        <div class="d-flex justify-content-center">
    {{ $users->links('pagination::bootstrap-4')}}
</div>
 
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
@endsection