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
            window.onload = function () {
                alert("{{ session('success') }}");
            }
        </script>
    @endif

    <!-- Thông báo alert cho error -->
    @if(session()->has('error'))
        <script>
            window.onload = function () {
                alert("{{ session('error') }}");
            }
        </script>
    @endif
    <!-- Thanh sidebar -->
    <div class="d-flex">
        <!-- Thanh sidebar -->
        <aside class="sidebar" id="filter-form">
            <h4>Lọc Sản Phẩm</h4>
            <form id="filter-products" method="GET">
                <!-- Thương Hiệu -->
                <h5>Thương Hiệu</h5>
                @foreach($brands as $item)
                    <div>
                        <input type="checkbox" name="brand[]" value="{{ $item->BrandId }}" id="brand_{{ $item->BrandId }}"
                            style="margin-right: 5px;">
                        <label for="brand_{{ $item->BrandId }}" style="display: inline;">{{ $item->BrandName }}</label>
                    </div>
                @endforeach


                <hr>
                <!-- Giá từ - đến -->
                <h5>Giá</h5>
                <label for="minPrice">Giá Từ: </label>
                <input type="text" id="minPriceInput" value="0" placeholder="0" />VND
                <input type="range" min="0" max="1000000000" step="0" name="min_price" id="minPrice" value="0">
                <br>
                <label for="maxPrice">Đến: </label>
                <input type="text" id="maxPriceInput" value="1,000,000,000" placeholder="1000000000" />VND
                <input type="range" min="0" max="1000000000" step="0" name="max_price" id="maxPrice"
                    value="1000000000">
                <hr>
                <!-- Màu Sắc -->
                <h5>Màu Sắc</h5>
                <select name="color" id="color">
                    <option value="">Tất cả</option>
                    @foreach($colors as $color)
                        <option value="{{ $color }}">{{ ucfirst($color) }}</option>
                    @endforeach
                </select>

                <!-- Nút Lọc -->
                <button type="submit" id="apply-filter" class="btn btn-primary mt-2">Lọc</button>
            </form>
        </aside>

        <!-- Phần sản phẩm -->
        <section class="products">
            <h1><span>Sản Phẩm</span></h1>
            <div class="container">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 section-products" id="product-list">
                    @foreach($products as $product)
                        <div class="col">
                            <div class="product-card">
                                <div class="item-img">
                                   


                                     <a href="{{ route('detail.index', ['id' => \App\Helpers\IdEncoder::encodeId($product->ProductId)]) }}">
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
        </section>
    </div>
    <!-- Phân trang -->
    <div class="pagination">
        <!-- đầu << -->
        <!-- Nút đầu <<< -->
        @if ($products->onFirstPage())
            <button class="pagination-button" disabled>
                << </button>
        @else
            <a href="{{ $products->url(1) }}" class="pagination-button">
                << </a>
        @endif

                        <!-- Các trang ở giữa -->
                        @for ($i = 1; $i <= $products->lastPage(); $i++)
                            <a href="{{ $products->url($i) }}"
                                class="pagination-button {{ ($products->currentPage() == $i) ? 'active' : '' }}">
                                {{ $i }}
                            </a>
                        @endfor

                        <!-- Nút cuối >> -->
                        @if ($products->hasMorePages())
                            <a href="{{ $products->url($products->lastPage()) }}" class="pagination-button">>></a>
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

                    <form action="{{ route('subscribe') }}" method="POST">
                        @csrf
                        <div class="col-auto d-flex align-items-center">
                            <p>Đăng Ký Nhận Tin
                                <br>
                                Nhận thông tin mới nhất về siêu xe và ưu đãi đặc biệt:
                            </p>
                            <input type="email" name="email" placeholder="Email của bạn" class="form-control mx-2"
                                style="width: auto;" required>
                            <button type="submit" class="btn btn-dark">ĐĂNG KÝ</button>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success mt-2">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger mt-2">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>



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
    $(document).ready(function () {
        // Đồng bộ khi người dùng thay đổi giá trị thanh trượt
        $('#minPrice').on('input', function () {
            let minPrice = parseInt($(this).val());
            let maxPrice = parseInt($('#maxPrice').val());

            // Giới hạn minPrice không vượt quá maxPrice
            if (minPrice > maxPrice) {
                minPrice = maxPrice;
                $(this).val(minPrice);
            }

            $('#minPriceInput').val(new Intl.NumberFormat().format(minPrice));
        });

        $('#maxPrice').on('input', function () {
            let maxPrice = parseInt($(this).val());
            let minPrice = parseInt($('#minPrice').val());

            // Giới hạn maxPrice không thấp hơn minPrice
            if (maxPrice < minPrice) {
                maxPrice = minPrice;
                $(this).val(maxPrice);
            }

            $('#maxPriceInput').val(new Intl.NumberFormat().format(maxPrice));
        });

        // Đồng bộ khi người dùng nhập giá trị trực tiếp vào ô input
        $('#minPriceInput').on('input', function () {
            let minPrice = parseInt($(this).val().replace(/,/g, '')) || 0;
            let maxPrice = parseInt($('#maxPrice').val());

            // Giới hạn minPrice không vượt quá maxPrice
            if (minPrice > maxPrice) {
                minPrice = maxPrice;
            }

            $('#minPrice').val(minPrice);
            $(this).val(new Intl.NumberFormat().format(minPrice));
        });

        $('#maxPriceInput').on('input', function () {
            let maxPrice = parseInt($(this).val().replace(/,/g, '')) || 0;
            let minPrice = parseInt($('#minPrice').val());

            // Giới hạn maxPrice không thấp hơn minPrice
            if (maxPrice < minPrice) {
                maxPrice = minPrice;
            }

            $('#maxPrice').val(maxPrice);
            $(this).val(new Intl.NumberFormat().format(maxPrice));
        });
    });
    $(document).ready(function () {
        $(document).on('click', '#apply-filter', function (e) {
            e.preventDefault();
            fetchFilteredProducts();
        });

        function fetchFilteredProducts() {
            let selectedBrands = [];
            $('input[name="brand[]"]:checked').each(function () {
                selectedBrands.push($(this).val());
            });
            $.ajax({
                url: '{{ route('product.filter') }}',
                method: 'GET',
                data: {
                    brand: selectedBrands,
                    min_price: $('#minPrice').val(),
                    max_price: $('#maxPrice').val(),
                    color: $('#color').val()
                },
                success: function (response) {
                    $('#product-list').html(response.html); // Đưa partial view vào HTML
                },
                error: function () {
                    alert('Đã xảy ra lỗi khi tải sản phẩm.');
                }
            });
        }

        // Cập nhật giá trị input khi kéo thanh trượt
        $(document).on('input', '#minPrice', function () {
            $('#minPriceInput').val($(this).val());
        });
        // Khi nhập vào trường maxPrice
        $(document).on('input', '#maxPrice', function () {
            $('#maxPriceInput').val($(this).val());
        });
    });


    $(document).ready(function () {
        // Hàm để định dạng số
        function formatNumber(value) {
            return value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        // Cập nhật thanh trượt khi thay đổi ô input
        $('#minPriceInput').on('input', function () {
            let value = $(this).val().replace(/[^0-9]/g, ''); // Chỉ lấy số
            if (parseInt(value) > parseInt($('#minPrice').attr('max'))) {
                value = $('#minPrice').attr('max');
            }
            $(this).val(formatNumber(value));
            $('#minPrice').val(value);
        });

        $('#maxPriceInput').on('input', function () {
            let value = $(this).val().replace(/[^0-9]/g, ''); // Chỉ lấy số
            if (parseInt(value) > parseInt($('#maxPrice').attr('max'))) {
                value = $('#maxPrice').attr('max');
            }
            $(this).val(formatNumber(value));
            $('#maxPrice').val(value);
        });

        // Cập nhật ô input khi thay đổi thanh trượt minPrice
        $(document).on('input', '#minPrice', function () {
            let value = $(this).val();
            $('#minPriceInput').val(formatNumber(value));
        });

        // Cập nhật ô input khi thay đổi thanh trượt maxPrice
        $(document).on('input', '#maxPrice', function () {
            let value = $(this).val();
            $('#maxPriceInput').val(formatNumber(value));
        });

        // Khởi tạo giá trị mặc định
        $('#minPriceInput').val(formatNumber(0));
        $('#maxPriceInput').val(formatNumber(10000000));
    });







</script>
@endsection