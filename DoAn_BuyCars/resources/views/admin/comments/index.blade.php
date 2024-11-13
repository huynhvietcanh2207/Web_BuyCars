@extends('admin')

@section('main')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Bình luận</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="bg-light">
    <div class="container bg-white p-4 shadow">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h4">Quản lý Bình luận</h1>
         <!--   <a href="{{ route('comments.create') }}" class="btn btn-primary">Thêm Bình luận</a>  -->
        </div>

        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">ID Sản Phẩm</th>
                    <th scope="col">ID Người Dùng</th>
                    <th scope="col">Nội dung Bình luận</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <td>{{ $comment->CommentId }}</td> <!-- ID bình luận -->
                        <td>{{ $comment->ProductId }}</td> <!-- ID sản phẩm -->
                        <td>{{ $comment->id }}</td> <!-- ID Người Dùng -->
                        <td>{{ $comment->CommentText }}</td>
                        <td>{{ \Carbon\Carbon::parse($comment->CreatedAt)->format('d/m/Y H:i:s') }}</td> <!-- Ngày cập nhật -->
                        <td class="text-center">
                            <div class="d-flex justify-content-around">
                                <a href="{{ route('comments.edit', $comment->CommentId) }}" class="text-primary" title="Sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('comments.destroy', $comment->CommentId) }}" method="POST"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa bình luận này không?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-danger" title="Xóa"
                                        style="border: none; background: none; cursor: pointer;">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-3">
            <nav>
                <ul class="pagination">
                    <!-- Nút Previous -->
                    <li class="page-item {{ $comments->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $comments->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <!-- Các trang -->
                    @foreach ($comments->getUrlRange(1, $comments->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $comments->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                    @endforeach

                    <!-- Nút Next -->
                    <li class="page-item {{ $comments->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $comments->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

@endsection
