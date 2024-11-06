@extends('admin')
@section('main')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sản phẩm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="bg-light">
    <div class="container bg-white p-4 shadow">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h4">Quản lý Thương Hiệu</h1>
            <a href="{{ route('brands.create') }}" class="btn btn-primary">Thêm</a>
        </div>

        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên thương hiệu</th>
                    <th scope="col">Hình ảnh thương hiệu</th>
                    <th scope="col">Created_at</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($brands as $brand)
                <tr>
                    <td>{{ $brand->BrandId }}</td>
                    <td>{{ $brand->BrandName }}</td>
                    <td><img src="{{ asset($brand->image_url) }}" class="d-block w-50 img-fluid"></td>
                    <td>{{ $brand->created_at }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-around">
                            <a href="{{ route('brands.edit', $brand->BrandId) }}" class="text-primary" title="Sửa">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('brands.destroy', $brand->BrandId) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa thương hiệu này không?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-danger" title="Xóa" style="border: none; background: none; cursor: pointer;">
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
                    <li class="page-item {{ $brands->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $brands->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    @foreach ($brands->getUrlRange(1, $brands->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $brands->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                    @endforeach

                    <li class="page-item {{ $brands->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $brands->nextPageUrl() }}" aria-label="Next">
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