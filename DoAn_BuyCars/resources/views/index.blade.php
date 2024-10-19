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
  
    <main class="main-banner">
        <img src="banner2.jpg" alt="Supercar Banner">
    </main>
    <!-- sản phẩm -->
    <section class="products">
        <h1>Sản <span>Phẩm</span></h1>
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
                    <button class="pagination-button">1</button>
                    <button class="pagination-button">2</button>
                    <button class="pagination-button active">3</button>
                    <button class="pagination-button">4</button>
                    <button class="pagination-button"> >> </button>
        </div>
    </section>
    <!-- sản phẩm mới -->
    <div class="section-newProducts">
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <h1>Sản Phẩm <span>Mới</span></h1>
            <div class="carousel-inner">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row item-products">
                            <div class="col-lg-7 col-md-6 col-sm-12">
                                <img src="56.jpg" class="d-block w-100 img-fluid" alt="Slide 1">
                            </div>
                            <div class="col-lg-5 col-md-6 col-sm-12 d-flex  flex-column justify-content-center">
                                <h3>Product 1</h3>
                                <p>Giới thiệu sương sương</p>
                                <div class="name-newProducts">
                                    Name: <a href="#">ABC</a>
                                </div>
                                <div class="about">
                                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Omnis, eos!</p>
                                </div>
                                <button class="btn btn-silder btn-primary mt-auto">Thêm vào giỏ hàng</button>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item">
                            <div class="row item-products">
                                <div class="col-lg-7 col-md-6 col-sm-12">
                                    <img src="56.jpg" class="d-block w-100 img-fluid" alt="Slide 1">
                                </div>
                                <div class="col-lg-5 col-md-6 col-sm-12 d-flex  flex-column justify-content-center">
                                    <h3>Product 1</h3>
                                    <p>Giới thiệu sương sương</p>
                                    <div class="name-newProducts">
                                        Name: <a href="#">ABC</a>
                                    </div>
                                    <div class="about">
                                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Omnis, eos!</p>
                                    </div>
                                    <button class="btn btn-silder btn-primary mt-auto">Thêm vào giỏ hàng</button>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row item-products">
                                <div class="col-lg-7 col-md-6 col-sm-12">
                                    <img src="56.jpg" class="d-block w-100 img-fluid" alt="Slide 1">
                                </div>
                                <div class="col-lg-5 col-md-6 col-sm-12 d-flex  flex-column justify-content-center">
                                    <h3>Product 1</h3>
                                    <p>Giới thiệu sương sương</p>
                                    <div class="name-newProducts">
                                        Name: <a href="#">ABC</a>
                                    </div>
                                    <div class="about">
                                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Omnis, eos!</p>
                                    </div>
                                    <button class="btn btn-silder btn-primary mt-auto">Thêm vào giỏ hàng</button>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row item-products">
                                <div class="col-lg-7 col-md-6 col-sm-12">
                                    <img src="56.jpg" class="d-block w-100 img-fluid" alt="Slide 1">
                                </div>
                                <div class="col-lg-5 col-md-6 col-sm-12 d-flex  flex-column justify-content-center">
                                    <h3>Product 1</h3>
                                    <p>Giới thiệu sương sương</p>
                                    <div class="name-newProducts">
                                        Name: <a href="#">ABC</a>
                                    </div>
                                    <div class="about">
                                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Omnis, eos!</p>
                                    </div>
                                    <button class="btn btn-silder btn-primary mt-auto">Thêm vào giỏ hàng</button>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row item-products">
                                <div class="col-lg-7 col-md-6 col-sm-12">
                                    <img src="56.jpg" class="d-block w-100 img-fluid" alt="Slide 1">
                                </div>
                                <div class="col-lg-5 col-md-6 col-sm-12 d-flex  flex-column justify-content-center">
                                    <h3>Product 1</h3>
                                    <p>Giới thiệu sương sương</p>
                                    <div class="name-newProducts">
                                        Name: <a href="#">ABC</a>
                                    </div>
                                    <div class="about">
                                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Omnis, eos!</p>
                                    </div>
                                    <button class="btn btn-silder btn-primary mt-auto">Thêm vào giỏ hàng</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- boostrap Carousel controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </div>


        </div>
    </div>
    <!-- about -->
    <div class="about" id="About">

        <h1>Web<span>About</span></h1>

        <div class="about_main">
            <div class="about_image">
                <div class="about_small_image">
                    <img src="banner2.jpg" onclick="functio(this)">
                    <img src="banner1.jpg" onclick="functio(this)">
                    <img src="banner2.jpg" onclick="functio(this)">
                    <img src="banner1.jpg" onclick="functio(this)">
                </div>

                <div class="image_contaner">
                    <img src="banner2.jpg" id="imagebox">
                </div>

            </div>

            <div class="about_text">
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet fugit provident suscipit
                    reprehenderit labore mollitia, placeat esse quas, nesciunt itaque deleniti earum adipisci repellat
                    non voluptatem illum aut expedita nisi. Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet fugit provident suscipit
                    reprehenderit labore mollitia, placeat esse quas, nesciunt itaque deleniti earum adipisci repellat
                    non voluptatem illum aut expedita nisi. Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet fugit provident suscipit
                    reprehenderit labore mollitia, placeat esse quas, nesciunt itaque deleniti earum adipisci repellat
                    non voluptatem illum aut expedita nisi. Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet fugit provident suscipit
                    reprehenderit labore mollitia, placeat esse quas, nesciunt itaque deleniti earum adipisci repellat
                    non voluptatem illum aut expedita nisi.
                </p>
            </div>

        </div>

        <a href="#" class="about_btn">Shop Now</a>

        <script>
            function functio(small) {
                var full = document.getElementById("imagebox")
                full.src = small.src
            }
        </script>

    </div>

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