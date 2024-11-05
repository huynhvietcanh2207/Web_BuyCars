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
                value="{{ old('VoucherCode', $voucher->VoucherCode) }}" required>
            @if ($errors->has('VoucherCode'))
                <span class="text-danger">{{ $errors->first('VoucherCode') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="DiscountPercentage">Giảm giá (%)</label>
            <input type="number" name="DiscountPercentage" id="DiscountPercentage" class="form-control"
                value="{{ old('DiscountPercentage', $voucher->DiscountPercentage) }}" min="0" max="100" required>
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