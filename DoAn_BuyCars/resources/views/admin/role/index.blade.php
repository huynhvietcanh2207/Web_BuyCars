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
            <h1 class="h4">Quản lý Role</h1>
            <a href="{{ route('role.create') }}" class="btn btn-primary">Thêm</a>
        </div>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên Role</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->RoleName }}</td>
                        <td>{{ $role->Description }}</td>
                        <td>{{ $role->created_at }}</td>
                        <td class="text-center">
                            <a href="{{ route('role.edit', $role->id) }}" class="text-primary">Sửa</a>
                            <form action="{{ route('role.destroy', $role->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</button>
                            </form>
                        </td>
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