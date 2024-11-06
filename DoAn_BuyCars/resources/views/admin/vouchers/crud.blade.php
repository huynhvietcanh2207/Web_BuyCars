@extends('admin')

@section('main')
<div class="container">
    <h1 class="h4 mb-4">Thêm Voucher Mới</h1>
    <form action="{{ route('vouchers.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="VoucherCode">Mã Voucher</label>
                    <input type="text" class="form-control" id="VoucherCode" name="VoucherCode" required>
                    @if ($errors->has('VoucherCode'))
                        <span class="text-danger">{{ $errors->first('VoucherCode') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="DiscountPercentage">Giảm giá (%)</label> <!-- Cập nhật tiêu đề trường -->
                    <input type="number" class="form-control" id="DiscountPercentage" name="DiscountPercentage" step="0.01" required> <!-- Thay đổi tên trường -->
                    @if ($errors->has('DiscountPercentage'))
                        <span class="text-danger">{{ $errors->first('DiscountPercentage') }}</span> <!-- Cập nhật để hiển thị lỗi cho DiscountPercentage -->
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="ExpirationDate">Ngày hết hạn</label>
                    <input type="date" class="form-control" id="ExpirationDate" name="ExpirationDate" required>
                    @if ($errors->has('ExpirationDate'))
                        <span class="text-danger">{{ $errors->first('ExpirationDate') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="IsActive">Trạng thái</label>
                    <select class="form-control" id="IsActive" name="IsActive" required>
                        <option value="1">Đang hoạt động</option>
                        <option value="0">Không hoạt động</option>
                    </select>
                    @if ($errors->has('IsActive'))
                        <span class="text-danger">{{ $errors->first('IsActive') }}</span>
                    @endif
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Lưu Voucher</button>
        <a href="{{ route('vouchers.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
