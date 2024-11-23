<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <title>@yield('titile', 'BuyCars')</title>
    <style>
        .dropdown-user {
            position: relative;
            display: inline-block;
        }

        .dropdown-sidebar {
            position: relative;
            display: inline-block;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 4px;
            z-index: 1000;
        }

        .dropdown-sidebar.active .dropdown-menu {
            display: block;
        }


        .dropdown-user:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: black;
        }

        .dropdown-menu a:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
@if (session()->has('success'))
    <script>
        window.onload = function () {
            alert("{{ session('success') }}");
    }
    </script>
@endif

<!-- Thông báo alert cho error -->
@if (session()->has('error'))
    <script>
        window.onload = function () {
            alert("{{ session('error') }}");
    }
    </script>
@endif

<body>
    <!-- header -->
    <header>
        <div class="container-header header-content">
            <div class="logo">
                <a href="{{ route('index') }}">
                    <img src="logoweb.jpg" alt="LOGO"> <!-- Thay thế với URL logo của bạn -->
                </a>
            </div>

            <nav>
                <a href="{{ route('index') }}">Trang Chủ</a>
                <a href="{{ route('product') }}">Sản Phẩm</a>
                <div class="dropdown-sidebar">
                    <a class="dropdown-toggle" href="#" id="brandDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Thương Hiệu
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="brandDropdown">
                        <li>
                            <a class="dropdown-item" href="/brands">Tất cả thương hiệu</a>
                        </li>
                        @foreach ($sidebar_brands as $row)
                            <li>
                                <a class="dropdown-item" href="{{ route('brands.showBrand', $row->BrandId) }}">{{ $row->BrandName }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <a href=" #new-products">Sản Phẩm Mới</a>
                            <a href="#About">Giới Thiệu</a>
                            <a href="{{ route('favorites.index') }}">Yêu Thích</a>
            </nav>
            <div class="theme-switch">
                <label class="switch">
                    <input type="checkbox" id="themeToggle">
                    <span class="slider"></span>
                </label>
                <span id="themeLabel">Sáng</span>
            </div>
            <div class="icons">
                <!-- Search Form -->
                <form action="{{ route('search') }}" method="GET" class="d-flex align-items-center">
                    <!-- <input type="text" name="query" placeholder="Tìm kiếm..." class="form-control" style="width: 200px; margin-right: 10px;"> -->
                    <button type="submit" class="btn btn-light">
                        <i class="fas fa-search"></i>
                    </button>
                </form>

                <a href="{{ route('cart.index') }}"><i class="fas fa-shopping-cart"></i></a>
                <div class="dropdown-user">
                    <a href="#" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i></a>
                    <div class="dropdown-menu">
                        @auth
                        <a href="{{ route('account.profile') }}">Cá nhân</a>

                           

                            <a href=" {{ route('password.change') }}">Đổi Mật Khẩu</a>


                                <a href="{{ route('logout') }}"
                                onclick=" event.preventDefault(); document.getElementById('logout-form').submit();">Đăng
                                    Xuất</a>
                                <form id="logout-form" action="{{ route('logout') }}" method=" POST" style="display: none;">
                                    @csrf
                                </form>
                        @else
                        <a href="{{ route('login') }}">Đăng Nhập</a>
                        @endauth
                    </div>
                </div>



            </div>
        </div>
        </div>
        </div>
    </header>



    @yield('main')




    <!-- footer -->
    <footer class=" footer-content">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4 mb-4">
                                            <h5>Liên Hệ</h5>
                                            <p><i class="fas fa-phone-alt"></i> Điện thoại: <a href="tel:+84 0342779848"
                                                    class="text-white">+84
                                                    0342779848</a></p>
                                            <p><i class="fas fa-envelope"></i> Email: <a href="mailto:info@supercar.com"
                                                    class="text-white">huynhvietcanh2004@gmail.com</a></p>
                                            <p><i class="fas fa-map-marker-alt"></i> Địa chỉ: Thành Phố Hồ Chí Minh</p>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <h5>Kết Nối Với Chúng Tôi</h5>
                                            <p>Theo dõi chúng tôi trên các nền tảng mạng xã hội để không bỏ lỡ bất kỳ
                                                thông tin nào!</p>
                                            <div class="social-icons">
                                                <a href="#" class="text-white me-3" title="Facebook"><i
                                                        class="fab fa-facebook fa-2x"></i></a>
                                                <a href="#" class="text-white me-3" title="Instagram"><i
                                                        class="fab fa-instagram fa-2x"></i></a>
                                                <a href="#" class="text-white me-3" title="Twitter"><i
                                                        class="fab fa-twitter fa-2x"></i></a>
                                                <a href="#" class="text-white" title="YouTube"><i
                                                        class="fab fa-youtube fa-2x"></i></a>
                                            </div>
                                            <p class="mt-3">Hoặc quét mã QR bên dưới để theo dõi ngay:</p>
                                            <img src="55.jpg" alt="QR Code" class="img-fluid" style="width: 100px;">
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <h5>Đăng Nhập</h5>
                                            <p>Nhập thông tin của bạn để truy cập tài khoản:</p>
                                            <form class="mb-3">
                                                <input type="email" placeholder="Email của bạn"
                                                    class="form-control mb-2" style="width: 100%; max-width: 400px;"
                                                    required>
                                                <input type="password" placeholder="Mật khẩu" class="form-control mb-2"
                                                    style="width: 100%; max-width: 400px;" required>
                                                <div class="d-flex justify-content-center">
                                                    <button class="btn btn-primary" type="submit"
                                                        style="width: 200px;">Đăng Nhập</button>
                                                </div>
                                            </form>
                                            <p class="mt-3"><i class="fas fa-user-lock"></i> Chúng tôi cam kết bảo mật
                                                thông tin của bạn.
                                            </p>
                                            <p><i class="fas fa-info-circle"></i> Nếu bạn quên mật khẩu, <a href="#"
                                                    class="text-white">nhấp vào
                                                    đây để khôi phục</a>.</p>
                                            <p><i class="fas fa-user-plus"></i> Chưa có tài khoản? <a href="#"
                                                    class="text-white">Đăng
                                                    ký
                                                    ngay</a>.</p>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <div class="text-center">
                                        <p>&copy; 2024 VietCanh. Bản quyền thuộc về chúng tôi. Tất cả quyền được bảo
                                            lưu.</p>
                                    </div>
                                </div>
                                </footer>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        const dropdowns = document.querySelectorAll('.dropdown-sidebar');

                                        dropdowns.forEach(dropdown => {
                                            dropdown.addEventListener('click', function (event) {
                                                event.stopPropagation(); // Ngăn chặn sự kiện click lan rộng
                                                this.classList.toggle('active');
                                            });
                                        });

                                        // Đóng menu khi click ngoài dropdown
                                        document.addEventListener('click', function () {
                                            dropdowns.forEach(dropdown => {
                                                dropdown.classList.remove('active');
                                            });
                                        });
                                    });
                                </script>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-L3BL0XgQYuk4S7Np7aANqAc99Z/3hZfPHq7nxDyoe37PMa3hb/jRlQi9lAQzS3t9" crossorigin="anonymous">
    </script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script src="{{ asset('js/animation.js') }}"></script>

</html>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const themeToggle = document.getElementById('themeToggle');
        const themeLabel = document.getElementById('themeLabel');

        // Kiểm tra nếu đã lưu theme trong localStorage
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-mode');
            themeToggle.checked = true;
            themeLabel.textContent = 'Tối';
        }

        themeToggle.addEventListener('change', function () {
            if (themeToggle.checked) {
                document.body.classList.add('dark-mode');
                localStorage.setItem('theme', 'dark');
                themeLabel.textContent = 'Tối';
            } else {
                document.body.classList.remove('dark-mode');
                localStorage.setItem('theme', 'light');
                themeLabel.textContent = 'Sáng';
            }
        });
    });
</script>