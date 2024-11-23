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
                    <input type="text" name="VoucherCode" id="VoucherCode" class="form-control"
                        value="{{ old('VoucherCode', $voucher->VoucherCode ?? '') }}" required minlength="5"
                        maxlength="20" pattern="^[A-Za-z0-9]+$"
                        title="Mã voucher chỉ được chứa chữ và số, không chứa ký tự đặc biệt.">
                    <small class="form-text text-muted">Mã voucher phải từ 5 đến 20 ký tự, chỉ bao gồm chữ và
                        số.</small>
                    @if ($errors->has('VoucherCode'))
                        <small class="form-text text-danger">
                            {{ $errors->first('VoucherCode') }}
                        </small>
                    @endif
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="DiscountPercentage">Giảm giá (%)</label>
                    <input type="number" class="form-control" id="DiscountPercentage" name="DiscountPercentage"
                        step="0.01" min="0" max="100" required> <!-- Thêm min và max để ràng buộc từ 0 đến 100 -->
                    <small class="form-text text-muted">Giảm giá phải từ 0 đến 100%.</small>
                    <!-- Thêm thông báo cho giảm giá -->
                    @if ($errors->has('DiscountPercentage'))
                        <span class="text-danger">{{ $errors->first('DiscountPercentage') }}</span>
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