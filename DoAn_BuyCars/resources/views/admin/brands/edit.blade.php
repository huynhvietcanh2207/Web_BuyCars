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

        <!-- Hiển thị thông báo lỗi nếu có -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('brands.update', $brand->BrandId) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="BrandName">Tên thương hiệu</label>
                <input type="text" name="BrandName" id="BrandName" class="form-control" 
                    value="{{ old('BrandName', $brand->BrandName) }}" required minlength="5" maxlength="50">
                <small class="form-text text-muted">Tên thương hiệu phải từ 5 đến 50 ký tự.</small>
            </div>

            <div class="form-group">
                <label for="file_upload">Hình ảnh thương hiệu</label>
                <input type="file" name="file_upload" id="file_upload" class="form-control">
                @if($brand->image_url)
                    <div class="mt-2">
                        <img src="{{ asset($brand->image_url) }}" alt="Hình ảnh thương hiệu" class="img-fluid" style="max-width: 200px;">
                        <p class="text-muted">Hình ảnh hiện tại</p>
                    </div>
                @endif
                <small class="form-text text-muted">Chỉ hỗ trợ hình ảnh JPG, PNG, GIF và kích thước tối đa 2MB.</small>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('brands.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>

</html>

@endsection
