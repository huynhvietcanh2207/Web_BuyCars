@extends('admin')
@section('main')
<div class="container">
    <h1 class="h4 mb-4">Thêm Thương Hiệu Mới</h1>
    <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="BrandName">Tên Thương Hiệu</label>
                    <input type="text" id="BrandName" name="BrandName" class="form-control" required minlength="5" maxlength="50">
                    <small class="form-text text-muted">Tên thương hiệu phải từ 5 đến 50 ký tự.</small>
                    @error('BrandName')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="file_upload">Hình Ảnh Thương Hiệu</label>
                    <input type="file" name="file_upload" id="file_upload" class="form-control" accept=".jpeg,.jpg,.png,.gif" required>
                    <small class="form-text text-muted">Chỉ chấp nhận hình ảnh JPG, PNG, GIF với kích thước tối đa 2MB.</small>
                    @if ($errors->has('file_upload'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('file_upload') }}</div>
                    @endif
                    @error('file_upload')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Lưu Thương Hiệu</button>
        <a href="{{ route('brands.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
