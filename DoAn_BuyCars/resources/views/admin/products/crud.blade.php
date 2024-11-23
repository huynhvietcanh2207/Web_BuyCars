@extends('admin')

@section('main')
<div class="container mt-4">
    <h1 class="h4 mb-4">Thêm sản phẩm mới</h1>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Tên sản phẩm <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name" required>
            @if ($errors->has('name'))
                <small class="text-danger">{{ $errors->first('name') }}</small>
            @endif
        </div>

        <div class="form-group">
            <label for="BrandId">Thương hiệu <span class="text-danger">*</span></label>
            <select class="form-control" id="BrandId" name="BrandId" required>
                <option value="">-- Chọn thương hiệu --</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->BrandId }}">{{ $brand->BrandName }}</option>
                @endforeach
            </select>
            @if ($errors->has('BrandId'))
                <small class="text-danger">{{ $errors->first('BrandId') }}</small>
            @endif
        </div>

        <div class="form-group">
            <label for="file_upload">Hình ảnh <span class="text-danger">*</span></label>
            <input type="file" name="file_upload" id="file_upload" class="form-control" required>
            @if ($errors->has('file_upload'))
                <small class="text-danger">{{ $errors->first('file_upload') }}</small>
            @endif
        </div>

        <div class="form-group">
            <label for="price">Giá <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="price" name="price" required>
            @if ($errors->has('price'))
                <small class="text-danger">{{ $errors->first('price') }}</small>
            @endif
        </div>

        <div class="form-group">
            <label for="quantity">Số lượng <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
            @if ($errors->has('quantity'))
                <small class="text-danger">{{ $errors->first('quantity') }}</small>
            @endif
        </div>

        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea class="form-control" id="description" name="description" rows="4"></textarea>
            @if ($errors->has('description'))
                <small class="text-danger">{{ $errors->first('description') }}</small>
            @endif
        </div>

        <div class="form-group">
            <label for="color">Màu sắc</label>
            <input type="text" class="form-control" id="color" name="color">
            @if ($errors->has('color'))
                <small class="text-danger">{{ $errors->first('color') }}</small>
            @endif
        </div>

        <button type="submit" class="btn btn-success">Lưu sản phẩm</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
