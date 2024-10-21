@extends('header_footer')

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
@section('main')
    <!-- header -->

    <!-- sản phẩm -->
    <section class="products">
        <h1><span>Sản Phẩm Yêu Thích</span></h1>
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 section-products">
                <div class="col">
                    <div class="product-card">
                        <img class="image-products" src="banner2.jpg" alt="hình ảnh">
                        <div class="product-title">Tên Sản Phẩm 1</div>
                        <div class="product-price">Giá 1</div>
                        <div class="icon-btn">
                            <div class="icon-products">
                                <i class="fas fa-heart"></i>
                            </div>
                            <button class="btn-add-to-cart">Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <img class="image-products" src="banner2.jpg" alt="hình ảnh">
                        <div class="product-title">Tên Sản Phẩm 2</div>
                        <div class="product-price">Giá 2</div>
                        <div class="icon-btn">
                            <div class="icon-products">
                                <i class="fas fa-heart"></i>
                            </div>
                            <button class="btn-add-to-cart">Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <img class="image-products" src="banner2.jpg" alt="hình ảnh">
                        <div class="product-title">Tên Sản Phẩm 3</div>
                        <div class="product-price">Giá 3</div>
                        <div class="icon-btn">
                            <div class="icon-products">
                                <i class="fas fa-heart"></i>
                            </div>
                            <button class="btn-add-to-cart">Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <img class="image-products" src="banner2.jpg" alt="hình ảnh">
                        <div class="product-title">Tên Sản Phẩm 4</div>
                        <div class="product-price">Giá 4</div>
                        <div class="icon-btn">
                            <div class="icon-products">
                                <i class="fas fa-heart"></i>
                            </div>
                            <button class="btn-add-to-cart">Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <img class="image-products" src="banner2.jpg" alt="hình ảnh">
                        <div class="product-title">Tên Sản Phẩm 1</div>
                        <div class="product-price">Giá 1</div>
                        <div class="icon-btn">
                            <div class="icon-products">
                                <i class="fas fa-heart"></i>
                            </div>
                            <button class="btn-add-to-cart">Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <img class="image-products" src="banner2.jpg" alt="hình ảnh">
                        <div class="product-title">Tên Sản Phẩm 2</div>
                        <div class="product-price">Giá 2</div>
                        <div class="icon-btn">
                            <div class="icon-products">
                                <i class="fas fa-heart"></i>
                            </div>
                            <button class="btn-add-to-cart">Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <img class="image-products" src="banner2.jpg" alt="hình ảnh">
                        <div class="product-title">Tên Sản Phẩm 3</div>
                        <div class="product-price">Giá 3</div>
                        <div class="icon-btn">
                            <div class="icon-products">
                                <i class="fas fa-heart"></i>
                            </div>
                            <button class="btn-add-to-cart">Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <img class="image-products" src="banner2.jpg" alt="hình ảnh">
                        <div class="product-title">Tên Sản Phẩm 4</div>
                        <div class="product-price">Giá 4</div>
                        <div class="icon-btn">
                            <div class="icon-products">
                                <i class="fas fa-heart"></i>
                            </div>
                            <button class="btn-add-to-cart">Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- phân trang -->
        <div class="pagination">
            <button class="pagination-button">
                << </button>
                    <button class="pagination-button active">1</button>
                    <button class="pagination-button">2</button>
                    <button class="pagination-button ">3</button>
                    <button class="pagination-button">4</button>
                    <button class="pagination-button"> >> </button>
        </div>
    </section>
    <!-- sản phẩm mới -->

    <!-- about -->
   
    <!-- icon-footer -->
    <section>
        <div class="container">
            <div class="row justify-content-around qq">
                <div class="col text-center icon-container">
                    <i class="fas fa-shipping-fast fa-4x"></i>
                    <p class="mt-2">Giao Hàng Nhanh</p>
                </div>
                <div class="col text-center icon-container">
                    <i class="fas fa-award fa-4x"></i>
                    <p class="mt-2">Dải hàng và đảm bảo nhất</p>
                </div>
                <div class="col text-center icon-container">
                    <i class="fas fa-headset fa-4x"></i>
                    <p class="mt-2">Hỗ trợ tư vấn 24/24</p>
                </div>
            </div>

            <hr class="my-4">

            <div class="icon-footer">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto social-icons">
                        <a href="">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                    
                    <!-- nhận mail -->
                    <div class="col-auto d-flex align-items-center">
                    <p>Đăng Ký Nhận Tin
                        <br>
                        Nhận thông tin mới nhất về siêu xe và ưu đãi đặc biệt:
                    </p>
                    <input type="email" placeholder="Email của bạn" class="form-control mx-2" style="width: auto;">
                    <button class="btn btn-dark">ĐĂNG KÝ</button>
                </div>

                    @if (session('success'))
                    <div class="alert alert-success mt-2">
                        {{ session('success') }}
                    </div>
                    @endif

                </div>
            </div>

            <hr class="my-4">
        </div>
    </section>
    <!-- footer -->
   
</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</html>
<script>
    //thêm vào giỏ hàng nhá
    document.querySelectorAll('.btn').forEach(button => {
        button.addEventListener('click', function() {
            alert('Sản phẩm đã được thêm vào giỏ hàng!');
        });
    });
</script>
@endsection