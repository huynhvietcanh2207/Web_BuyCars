@extends('admin')
@section('main')
<div class="container">
    <h1 class="h4 mb-4">Thêm thương hiệu mới mới</h1>
    <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="BrandName">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="BrandName" name="BrandName" required>
                </div>

            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="image_url">Vui Lòng Chọn Hình Ảnh:</label>
                    <input type="file" name="file_upload" id="file_upload" class="form-control" required>
                    @if ($errors->has('file_upload'))
                    <span class="text-danger">{{ $errors->first('file_upload') }}</span>
                    @endif

                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Lưu Thương Hiệu</button>
        <a href="{{ route('brands.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection