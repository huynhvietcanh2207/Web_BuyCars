@extends('admin')
@section('main')
<div class="container">
    <h1 class="h4 mb-4">Thêm sản phẩm mới</h1>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Tên sản phẩm</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="BrandId">ID thương hiệu</label>
            <select class="form-control" id="BrandId" name="BrandId" required>
                <option value="">Chọn thương hiệu</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->BrandId }}">{{ $brand->BrandName }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
                    <label for="image_url">Vui Lòng Chọn Hình Ảnh:</label>
                    <input type="file" name="file_upload" id="file_upload" class="form-control" required>
                    @if ($errors->has('file_upload'))
                    <span class="text-danger">{{ $errors->first('file_upload') }}</span>
                    @endif

                </div>
        <div class="form-group">
            <label for="price">Giá</label>
            <input type="text" class="form-control" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="color">Màu</label>
            <input type="text" class="form-control" id="color" name="color">
        </div>
        <button type="submit" class="btn btn-success">Lưu sản phẩm</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
