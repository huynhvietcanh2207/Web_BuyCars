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
<!-- Thông báo alert cho success -->
@if (session()->has('success'))
<script>
    window.onload = function() {
        alert("{{ session('success') }}");
    }
</script>
@endif

<!-- Thông báo alert cho error -->
@if (session()->has('error'))
<script>
    window.onload = function() {
        alert("{{ session('error') }}");
    }
</script>
@endif

<body class="bg-light">

    <div class="container bg-white p-4 shadow">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h4">Quản lý Thương Hiệu</h1>
            <a href="{{ route('brands.create') }}" class="btn btn-primary">Thêm</a>
        </div>
        <form action="{{ route('brands.index') }}" method="GET" class="mb-3">
            <div class="form-group position-relative">
                <label for="sort_by" class="font-weight-bold">Lọc</label>
                <select name="sort_by" id="sort_by" class="form-control custom-select" onchange="this.form.submit()">
                    <option value="asc" {{ request('sort_by') == 'asc' ? 'selected' : '' }}>Tăng dần</option>
                    <option value="desc" {{ request('sort_by') == 'desc' ? 'selected' : '' }}>Giảm dần</option>
                </select>
            </div>
        </form>

        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên thương hiệu</th>
                    <th scope="col">Hình ảnh thương hiệu</th>
                    <th scope="col">Created_at</th>
                    <th scope="col">Update_at</th>

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
                    <td>{{ $brand->updated_at }}</td>

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
<style>
    td {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        /*dau 3 cham*/
        max-width: 200px;
    }

    .custom-select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-color: #ffffff;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='currentColor'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M8 10l4 4 4-4'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 16px 16px;
        padding-right: 2rem;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        height: calc(2.25rem + 2px);
        width: 10%;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .custom-select:focus {
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    label {
        margin-bottom: 0.5rem;
    }
</style>

</html>
@endsection