@extends('admin')

@section('main')
<div class="container bg-white p-4 shadow">
    <h1 class="h4">Chỉnh sửa Voucher</h1>

    <form action="{{ route('vouchers.update', $voucher->VoucherId) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="VoucherCode">Mã Voucher</label>
            <input type="text" name="VoucherCode" id="VoucherCode" class="form-control"
                value="{{ old('VoucherCode', $voucher->VoucherCode ?? '') }}" required minlength="5" maxlength="20"
                pattern="^[A-Za-z0-9]+$" title="Mã voucher chỉ được chứa chữ và số, không chứa ký tự đặc biệt.">
            <small class="form-text text-muted">Mã voucher phải từ 5 đến 20 ký tự, chỉ bao gồm chữ và
                số.</small>
            @if ($errors->has('VoucherCode'))
                <small class="form-text text-danger">
                    {{ $errors->first('VoucherCode') }}
                </small>
            @endif
        </div>

        <div class="form-group">
            <label for="DiscountPercentage">Giảm giá (%)</label>
            <input type="number" class="form-control" id="DiscountPercentage" name="DiscountPercentage" step="0.01"
                min="0" max="100" value="{{ old('DiscountPercentage', $voucher->DiscountPercentage ?? '') }}" required>
            <!-- Thêm old() để giữ lại giá trị cũ nếu có lỗi -->
            <small class="form-text text-muted">Giảm giá phải từ 0 đến 100%.</small>
            <!-- Thêm thông báo cho giảm giá -->
            @if ($errors->has('DiscountPercentage'))
                <span class="text-danger">{{ $errors->first('DiscountPercentage') }}</span>
            @endif
        </div>


        <div class="form-group">
            <label for="ExpirationDate">Ngày hết hạn</label>
            <input type="date" name="ExpirationDate" id="ExpirationDate" class="form-control"
                value="{{ old('ExpirationDate', $voucher->ExpirationDate->format('Y-m-d')) }}" required>
            @if ($errors->has('ExpirationDate'))
                <span class="text-danger">{{ $errors->first('ExpirationDate') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="IsActive">Trạng thái</label>
            <select name="IsActive" id="IsActive" class="form-control" required>
                <option value="1" {{ $voucher->IsActive ? 'selected' : '' }}>Đang hoạt động</option>
                <option value="0" {{ !$voucher->IsActive ? 'selected' : '' }}>Không hoạt động</option>
            </select>
            @if ($errors->has('IsActive'))
                <span class="text-danger">{{ $errors->first('IsActive') }}</span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('vouchers.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection