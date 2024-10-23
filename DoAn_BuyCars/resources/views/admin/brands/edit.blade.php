@extends('admin')
@section('main')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa Thương Hiệu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="bg-light">
    <div class="container bg-white p-4 shadow">
        <h1 class="h4">Chỉnh sửa Thương Hiệu</h1>

        <form action="{{ route('brands.update', $brand->BrandId) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="BrandName">Tên thương hiệu</label>
                <input type="text" name="BrandName" id="BrandName" class="form-control" value="{{ old('BrandName', $brand->BrandName) }}" required>
            </div>

            <div class="form-group">
                <label for="file_upload">Hình ảnh thương hiệu</label>
                <input type="file" name="file_upload" id="file_upload" class="form-control">
                @if($brand->image_url)
                    <img src="{{ asset($brand->image_url) }}" alt="Hình ảnh thương hiệu" class="img-fluid mt-2" style="max-width: 200px;">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('brands.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>

</html>
@endsection
