@extends('admin')
@section('main')
<div class="container">
    <h1 class="h4 mb-4">Chỉnh sửa sản phẩm</h1>
    <form action="{{ route('products.update', $product->ProductId) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Tên sản phẩm</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
        </div>
        <div class="form-group">
            <label for="BrandId">ID thương hiệu</label>
            <select class="form-control" id="BrandId" name="BrandId" required>
                <option value="">Chọn thương hiệu</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->BrandId }}" {{ $product->BrandId == $brand->BrandId ? 'selected' : '' }}>{{ $brand->BrandName }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="file_upload">Hình ảnh hiện tại</label><br>
            <img src="{{ asset($product->image_url) }}" alt="Image" width="100">
            <input type="file" name="file_upload" id="file_upload" class="form-control mt-2">
        </div>
        <div class="form-group">
            <label for="price">Giá</label>
            <input type="text" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
        </div>
        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea class="form-control" id="description" name="description">{{ $product->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="color">Màu</label>
            <input type="text" class="form-control" id="color" name="color" value="{{ $product->color }}">
        </div>
        <button type="submit" class="btn btn-success">Cập nhật sản phẩm</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
