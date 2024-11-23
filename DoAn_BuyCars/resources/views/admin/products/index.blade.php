@extends('admin')

@section('main')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sản phẩm</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="bg-light">
    @if (session()->has('success'))
    <script>
        window.onload = function() {
            alert("{{ session('success') }}");
        }
    </script>
    @endif

    @if (session()->has('error'))
    <script>
        window.onload = function() {
            alert("{{ session('error') }}");
        }
    </script>
    @endif

    <div class="container bg-white p-4 shadow">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h4">Quản lý Sản phẩm</h1>
            <a href="{{ route('products.create') }}" class="btn btn-primary">Thêm mới</a>
        </div>

        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Thương hiệu</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Màu sắc</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->ProductId }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->brand->BrandName }}</td> <!-- Hiển thị tên thương hiệu -->
                     <td>{{ number_format($product->price, 0, ',', '.') }} VND</td>
                    <td>{{ $product->quantity }}</td>
                    <td>
                        @if ($product->image_url)
                        <img src="{{ asset($product->image_url) }}" class="img-fluid" style="max-width: 100px; height: auto;">
                        @else
                        <span>Không có hình ảnh</span>
                        @endif
                    </td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->color }}</td>
                    <td>{{ $product->created_at->format('d-m-Y H:i') }}</td>
                    <td class="text-center">
                        <a href="{{ route('products.edit', $product->ProductId) }}" class="text-primary mx-1">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('products.destroy', $product->ProductId) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?');">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-3">
            {{ $products->links() }}
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

@endsection
