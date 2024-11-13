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

    <!-- thoogn báo alert -->
    @if(session()->has('success'))
    <script>
        window.onload = function() {
            alert("{{ session('success') }}");
        }
    </script>
    @endif


    <!-- sản phẩm -->
    <section class="products">
        <h1><span>Sản Phẩm Yêu Thích</span></h1>
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 section-products">
                @foreach($favorites as $item)
                <div class="col">
                    <div class="product-card">
                        <img class="image-products" src="{{ $item->product->image_url }}" alt="hình ảnh">
                        <div class="product-title">{{ $item->product->name }}</div>
                        <div class="product-price">{{ number_format($item->product->price, 0, ',', '.') }} VND</div>
                        <div class="icon-btn">
                            <div class="icon-products">
                                <i class="{{ $item->product->ProductId ? 'fas fa-heart' : 'far fa-heart' }} favorite-btn"
                                    data-product-id="{{ $item->product->ProductId }}"></i>
                            </div>
                            <form action="{{ route('cart.add', $item->product->ProductId) }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item->product->ProductId }}">
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
        <div class="pagination">
            <!-- đầu << -->
            @if ($favorites->onFirstPage())
            <button class="pagination-button" disabled>
                << </button>
                    @else
                    <a href="{{ $favorites->url(1) }}" class="pagination-button">
                        << </a>
                            @endif


                            <!-- giữa -->
                            @for ($i = 1; $i <= $favorites->lastPage(); $i++)
                                <a href="{{ $favorites->url($i) }}"
                                    class="pagination-button {{ ($favorites->currentPage() == $i) ? 'active' : '' }}">
                                    {{ $i }}
                                </a>
                                @endfor

                                <!-- cuối >> -->
                                @if ($favorites->hasMorePages())
                                <a href="{{ $favorites->url($favorites->lastPage()) }}" class="pagination-button">>></a>
                                @else
                                <button class="pagination-button" disabled>>></button>
                                @endif
        </div>
    </section>
    </section>

    <!-- Sản phẩm mới -->


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
<x-ajax-add-favorite /> <!-- Sử dụng component -->

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