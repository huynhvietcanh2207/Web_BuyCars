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
    <!-- Thông báo alert cho success -->
@if(session()->has('success'))
    <script>
        window.onload = function() {
            alert("{{ session('success') }}");
        }
    </script>
@endif

<!-- Thông báo alert cho error -->
@if(session()->has('error'))
    <script>
        window.onload = function() {
            alert("{{ session('error') }}");
        }
    </script>
@endif


    <main class="main-banner">
        <img src="banner2.jpg" alt="Supercar Banner">
    </main>
    <!-- sản phẩm -->
    <section class="products">
        <h1>Sản <span>Phẩm</span></h1>
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 section-products">
                @foreach($products as $product)
                <div class="col">
                    <div class="product-card">
                        <img class="image-products" src="{{ $product->image_url }}" alt="hình ảnh">
                        <div class="product-title">{{ $product->name }}</div>
                        <div class="product-price">{{ number_format($product->price, 0, ',', '.') }} VND</div>
                        <div class="icon-btn">
                            <div class="icon-products">
                                <i class="fas fa-heart"></i>
                            </div>
                            <button class="btn-add-to-cart">Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Phân trang -->
        <div class="pagination">
            <!-- đầu << -->
            @if ($products->onFirstPage())
            <button class="pagination-button" disabled>
                <<< /button>
                    @else
                    <a href="{{ $products->url(1) }}" class="pagination-button"><<</a>
                            @endif

                            <!-- giữa -->
                            @for ($i = 1; $i <= $products->lastPage(); $i++)
                                <a href="{{ $products->url($i) }}" class="pagination-button {{ ($products->currentPage() == $i) ? 'active' : '' }}">
                                    {{ $i }}
                                </a>
                                @endfor

                                <!-- cuối >> -->
                                @if ($products->hasMorePages())
                                <a href="{{ $products->url($products->lastPage()) }}" class="pagination-button">>></a>
                                @else
                                <button class="pagination-button" disabled>>></button>
                                @endif
        </div>
    </section>
    </section>

    <!-- Sản phẩm mới -->
    <div class="section-newProducts">
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <h1>Sản Phẩm <span>Mới</span></h1>
            <div class="carousel-inner">
                @foreach($newProducts as $index => $products)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="row item-products">
                        <div class="col-lg-7 col-md-6 col-sm-12">
                            <img src="{{ $products->image_url }}" class="d-block w-100 img-fluid" alt="Slide {{ $index + 1 }}">
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12 d-flex flex-column justify-content-center">
                            <h3>{{ $products->name }}</h3>
                            <p>Giới thiệu sương sương</p>
                            <div class="name-newProducts">
                                Name: <a href="#">{{ $products->name }}</a>
                            </div>
                            <div class="about">
                                <p>{{ $products->description }}</p>
                            </div>
                            <button class="btn btn-silder btn-primary mt-auto">Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Bootstrap Carousel controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
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