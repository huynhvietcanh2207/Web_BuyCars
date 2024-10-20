<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>

    </style>
</head>

<body>
    <!-- header -->
    <header>
        <div class="container-header header-content">
            <div class="logo">
                <img src="banner1.jpg" alt="LOGO"> <!-- Replace with your logo URL -->
            </div>
            <nav>
                <a href="#">Trang Chủ</a>
                <a href="#">Sản Phẩm</a>
                <a href="#">Thương Hiệu <i class="fas fa-caret-down"></i></a>
                <a href="#">Sản Phẩm Mới</a>
                <a href="#">Giới Thiệu</a>
                <a href="#">Yêu Thích</a>
            </nav>
            <div class="icons">
                <a href="#"><i class="fas fa-search"></i></a>
                <a href="#"><i class="fas fa-shopping-cart"></i></a>
                <a href="#"><i class="fas fa-user"></i></a>
            </div>
        </div>
    </header>

    
        @yield('main')
   



    <!-- footer -->
    <footer class="footer-content">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>Liên Hệ</h5>
                    <p><i class="fas fa-phone-alt"></i> Điện thoại: <a href="tel:+84 0342779848" class="text-white">+84
                            0342779848</a></p>
                    <p><i class="fas fa-envelope"></i> Email: <a href="mailto:info@supercar.com"
                            class="text-white">huynhvietcanh2004@gmail.com</a></p>
                    <p><i class="fas fa-map-marker-alt"></i> Địa chỉ: Thành Phố Hồ Chí Minh</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Kết Nối Với Chúng Tôi</h5>
                    <p>Theo dõi chúng tôi trên các nền tảng mạng xã hội để không bỏ lỡ bất kỳ thông tin nào!</p>
                    <div class="social-icons">
                        <a href="#" class="text-white me-3" title="Facebook"><i class="fab fa-facebook fa-2x"></i></a>
                        <a href="#" class="text-white me-3" title="Instagram"><i class="fab fa-instagram fa-2x"></i></a>
                        <a href="#" class="text-white me-3" title="Twitter"><i class="fab fa-twitter fa-2x"></i></a>
                        <a href="#" class="text-white" title="YouTube"><i class="fab fa-youtube fa-2x"></i></a>
                    </div>
                    <p class="mt-3">Hoặc quét mã QR bên dưới để theo dõi ngay:</p>
                    <img src="55.jpg" alt="QR Code" class="img-fluid" style="width: 100px;">
                </div>

                <div class="col-md-4 mb-4">
                    <h5>Đăng Nhập</h5>
                    <p>Nhập thông tin của bạn để truy cập tài khoản:</p>
                    <form class="mb-3">
                        <input type="email" placeholder="Email của bạn" class="form-control mb-2"
                            style="width: 100%; max-width: 400px;" required>
                        <input type="password" placeholder="Mật khẩu" class="form-control mb-2"
                            style="width: 100%; max-width: 400px;" required>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary" type="submit" style="width: 200px;">Đăng Nhập</button>
                        </div>
                    </form>
                    <p class="mt-3"><i class="fas fa-user-lock"></i> Chúng tôi cam kết bảo mật thông tin của bạn.</p>
                    <p><i class="fas fa-info-circle"></i> Nếu bạn quên mật khẩu, <a href="#" class="text-white">nhấp vào
                            đây để khôi phục</a>.</p>
                    <p><i class="fas fa-user-plus"></i> Chưa có tài khoản? <a href="#" class="text-white">Đăng ký
                            ngay</a>.</p>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p>&copy; 2024 VietCanh. Bản quyền thuộc về chúng tôi. Tất cả quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-L3BL0XgQYuk4S7Np7aANqAc99Z/3hZfPHq7nxDyoe37PMa3hb/jRlQi9lAQzS3t9"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</html>