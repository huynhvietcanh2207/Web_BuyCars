@extends('admin')

@section('main')
<div class="detail">
<div class="container mt-4">
    <h1 class="text-primary text-center mb-4">Thông Tin Trang Website - BuyCars</h1>

    <!-- Thông tin chính về Website -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="card-title text-success">Về Chúng Tôi</h4>
                    <p class="card-text">
                        BuyCars là nền tảng mua bán xe hơi trực tuyến hàng đầu, giúp khách hàng kết nối với các đại lý uy tín và cập nhật thông tin xe mới nhất.
                    </p>
                    <p><strong>Sứ mệnh:</strong> Mang lại trải nghiệm mua xe tốt nhất cho khách hàng.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="card-title text-info">Dịch Vụ</h4>
                    <p class="card-text">
                        BuyCars cung cấp dịch vụ đa dạng từ tư vấn mua bán, cho vay tài chính đến bảo hành và bảo trì xe cho khách hàng.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-center shadow border-primary">
                <div class="card-body">
                    <h5 class="text-primary">Người Dùng</h5>
                    <p class="display-5">100,240+</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow border-success">
                <div class="card-body">
                    <h5 class="text-success">Xe Đã Bán</h5>
                    <p class="display-5">3,150+</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow border-info">
                <div class="card-body">
                    <h5 class="text-info">Đại Lý</h5>
                    <p class="display-5">250+</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow border-warning">
                <div class="card-body">
                    <h5 class="text-warning">Bình Luận</h5>
                    <p class="display-5">1,200+</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4 shadow-lg">
        <div class="card-body">
            <h3 class="text-secondary mb-3">Thông Tin Chi Tiết</h3>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Chỉ Mục</th>
                        <th>Chi Tiết</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ngày Thành Lập</td>
                        <td>01/10/2024</td>
                    </tr>
                    <tr>
                        <td>Địa Chỉ</td>
                        <td>123, Đường làng tăng phú, Tăng Nhơn Phú A, TP.HCM</td>
                    </tr>
                    <tr>
                        <td>Email Hỗ Trợ</td>
                        <td>huynhvietcanh@buycars.com</td>
                    </tr>
                    <tr>
                        <td>Số Điện Thoại</td>
                        <td>+84 342779848</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>

<style>
    /* .detail{
        background-image: url('hinhnenvutru.jpg');
    } */
    .card {
        transition: transform 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
</style>
@endsection
