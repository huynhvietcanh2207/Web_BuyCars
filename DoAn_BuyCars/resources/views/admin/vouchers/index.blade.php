@extends('admin')
@section('main')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Voucher</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="bg-light">
    <div class="container bg-white p-4 shadow">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h4">Quản lý Voucher</h1>
            <a href="{{ route('vouchers.create') }}" class="btn btn-primary">Thêm Voucher</a>
        </div>

        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Mã Voucher</th>
                    <th scope="col">Giảm giá (%)</th> 
                    <th scope="col">Ngày hết hạn</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vouchers as $voucher)
                <tr>
                    <td>{{ $voucher->VoucherId }}</td>
                    <td>{{ $voucher->VoucherCode }}</td>
                    <td>{{ $voucher->DiscountPercentage }} %</td>
                    <td>{{ $voucher->ExpirationDate }}</td>
                    <td>{{ $voucher->IsActive ? 'Đang hoạt động' : 'Không hoạt động' }}</td>
                    <td>{{ $voucher->created_at }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-around">
                            <a href="{{ route('vouchers.edit', $voucher->VoucherId) }}" class="text-primary" title="Sửa">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('vouchers.destroy', $voucher->VoucherId) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa voucher này không?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-danger" title="Xóa" style="border: none; background: none; cursor: pointer;">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-3">
            <nav>
                <ul class="pagination">
                    <li class="page-item {{ $vouchers->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $vouchers->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    @foreach ($vouchers->getUrlRange(1, $vouchers->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $vouchers->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    <li class="page-item {{ $vouchers->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $vouchers->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
@endsection
