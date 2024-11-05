@extends('admin')
@section('title', 'Danh Sách Role')
@section('main')

<body class="bg-light">

    <div class="container bg-white p-4 shadow">
        <!-- Hiển thị thông báo thành công -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Hiển thị thông báo lỗi -->
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h4">Danh sách phân quyền người dùng</h1>
            <a href="{{ route('role.assign') }}" class="btn btn-primary">Thêm phân quyền cho người dùng</a>
        </div>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Tên người dùng</th>
                    <th scope="col">Vai trò</th>
                    <th scope="col">Ngày phân quyền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assignments as $assignment)
                    <tr>
                        <td>{{ $assignment->user->username }}</td>
                        <td>{{ $assignment->role->RoleName }}</td>
                        <td>{{ $assignment->AssignedAt }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
@endsection