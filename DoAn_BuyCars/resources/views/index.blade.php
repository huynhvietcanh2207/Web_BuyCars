@extends('header_footer')

@section('main')
<!-- Thông báo alert cho success -->
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
<!-- Hiển thị thông tin người dùng -->
@if (auth()->check())
    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
@endif
<main class="main-banner">
    <video src="review.mp4" autoplay muted loop></video>
    <div class="banner-text ">
        <h1>Trải nghiệm đỉnh cao tốc độ và thiết kế!</h1>
        <p>Vượt qua mọi giới hạn với siêu phẩm này</p>
        <p>Thiết kế hiện đại, hiệu suất tối đa.
            Siêu xe – Định nghĩa mới của tốc độ.
        </p>
    </div>
</main>
<!-- sản phẩm -->
<section class="products">
    <div class="text-banner">
        <h1>Sản <span>Phẩm</span></h1>
    </div>
    <div class="container container-products">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 section-products">
            @foreach ($products as $product)
                <div class="col">
                    <div class="product-card">
                        <div class="item-img">
                            <a href="{{ route('detail.index', ['id' => $product->ProductId]) }}">
                                <img class="image-products" src="{{ ($product->image_url) }}" alt="{{$product->name}}">
                            </a>
                        </div>
                        <div class="product-title">{{ $product->name }}</div>
                        <div class="product-price">{{ number_format($product->price, 0, ',', '.') }} VND</div>
                        <div class="icon-btn">
                            <div class="icon-products">
                                <i class="{{ $product->is_favorited ? 'fas fa-heart' : 'far fa-heart' }} favorite-btn"
                                    data-product-id="{{ $product->ProductId }}"></i>
                            </div>
                            {{-- <button class="btn-add-to-cart">Thêm vào giỏ hàng</button> --}}
                            <form action="{{ route('cart.add', $product->ProductId) }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->ProductId }}">
                                @if (auth()->check())
                                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                @endif
                                <button class="btn-add-to-cart" type="submit">Thêm vào giỏ hàng</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Phân trang -->
    <div class="pagination product-pagination">
        <!-- đầu << -->
        @if ($products->onFirstPage())
            <button class="pagination-button" disabled>
                << </button>
        @else
            <a href="{{ $products->url(1) }}" class="pagination-button">
                << </a>
        @endif
                        <!-- giữa -->
                        @for ($i = 1; $i <= $products->lastPage(); $i++)
                            <a href="{{ $products->url($i) }}"
                                class="pagination-button {{ $products->currentPage() == $i ? 'active' : '' }}">
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
<div class="section-newProducts" id="new-products">
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="text-product-new">
            <h1>Sản Phẩm <span>Mới</span></h1>
        </div>
        <div class="carousel-inner product-news">
            @foreach ($newProducts as $index => $products)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="row item-products">
                        <div class="col-lg-7 col-md-6 col-sm-12">
                            <img src="{{ $products->image_url }}" class="d-block  img-fluid" alt="Slide {{ $index + 1 }}">
                        </div>
                        <div
                            class="col-lg-5 col-md-6 col-sm-12 d-flex flex-column justify-content-center carousel-item-text">
                            <div class="name-newProducts">
                                <h1><a href="#">{{ $products->name }}</a></h1>
                            </div>
                            <p>Giới thiệu sương sương</p>

                            <div class="price-newProducts">
                                Giá: <a href="#">{{ $products->price }} VND</a>
                            </div>
                            <div class="description">
                                <p>{{ $products->description }}</p>
                            </div>
                            <form action="{{ route('cart.add', $product->ProductId) }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->ProductId }}">

                                @if (auth()->check())
                                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                @endif
                                <button class="btn-add-to-cart" data-id="{{ $product->ProductId }}"
                                    data-price="{{ $product->price }}">Thêm vào giỏ hàng</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
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
</div>

<!-- about -->
<div class="about" id="About">
    <div class="text-about">
        <h1>Web<span>About</span></h1>

    </div>

    <div class="about_main">
        <div class="about_image about-footerr">
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

        <div class="about_text about-footerrr">
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet fugit provident suscipit
                reprehenderit labore mollitia, placeat esse quas, nesciunt itaque deleniti earum adipisci repellat
                non voluptatem illum aut expedita nisi. Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Eveniet fugit provident suscipit
                reprehenderit labore mollitia, placeat esse quas, nesciunt itaque deleniti earum adipisci repellat
                non voluptatem illum aut expedita nisi. Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Eveniet fugit provident suscipit
                reprehenderit labore mollitia, placeat esse quas, nesciunt itaque deleniti earum adipisci repellat
                non voluptatem illum aut expedita nisi. Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Eveniet fugit provident suscipit
                reprehenderit labore mollitia, placeat esse quas, nesciunt itaque deleniti earum adipisci repellat
                non voluptatem illum aut expedita nisi.
            </p>
        </div>

    </div>

    <a href="#" class="about_btn btn-footerr">Shop Now</a>

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

        <div class="icon-footer icon-footer">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-3 social-icons">
                    <a href=""><i class="fab fa-google"></i></a>
                    <a href=""><i class="fab fa-facebook"></i></a>
                    <a href=""><i class="fab fa-instagram"></i></a>
                    <a href=""><i class="fab fa-youtube"></i></a>
                </div>

                <div class="col-lg-9">
                    <form action="{{ route('subscribe') }}" method="POST">
                        @csrf
                        <div class="d-flex align-items-center">
                            <p>Đăng Ký Nhận Tin<br>Nhận thông tin mới nhất về siêu xe và ưu đãi đặc biệt:</p>
                            <input type="email" name="email" placeholder="Email của bạn" class="form-control mx-2"
                                style="width: auto;" required>
                            <button type="submit" class="btn btn-dark">ĐĂNG KÝ</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>

    </div>

    <hr class="my-4">
    </div>
</section>
<!-- footer -->

</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<x-ajax-add-favorite /> <!-- Sử dụng component -->

</html>
<script>
    // //thêm vào giỏ hàng nhá
    // document.querySelectorAll('.btn').forEach(button => {
    //     button.addEventListener('click', function() {
    //         alert('Sản phẩm đã được thêm vào giỏ hàng!');
    //     });
    // });
</script>
@endsection