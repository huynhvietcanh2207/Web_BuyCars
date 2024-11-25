@extends('header_footer')
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DETAIL - {{ $product->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>

    <link rel="stylesheet" href="{{ url('css/detail.css') }}">
</head>

<body>
    @section('main')
    <div class="banner">
        <div class="cart-header text-center">
            <img src="{{ asset('images/banner1.jpg') }}" alt="Banner">
            <h1>GHI TIẾT SẢN PHẨM</h1>
            <p><span id="hightlight">Trang chủ ></span> Chi tiết sản phẩm: <strong>{{ $product->name }}</strong></p>
        </div>
    </div>
    <div class="container detailform">
        <div class="row">
            <div class="col-md-6 imgdetail">
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset($product->image_url) }}" class="d-block" alt="{{ $product->name }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1 line"></div>
            <!-- Product Information -->
            <div class="col-md-5">
                <div class="detailinfo">
                    <h3>{{ $product->name }}</h3>
                    <p>Thương hiệu: Đang cập nhật...</p>
                    <h4 class="text-danger pricedetail">{{ number_format($product->price, 0, ',', '.') }} VNĐ</h4>
                    <div class="input-group mb-3">
                        <button class="btn btn-outline-secondary" type="button">-</button>
                        <input type="text" class="form-control text-center" value="1" style="max-width: 60px;" min="1">
                        <button class="btn btn-outline-secondary" type="button">+</button>
                    </div>
                    <form action="{{ route('cart.add', $product->ProductId) }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->ProductId }}">
                        @if (auth()->check())
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        @endif
                        <button class="btn-add-to-cart" type="submit"><strong>THÊM GIỎ HÀNG</strong></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <ul class="nav nav-tabs product-info-tabs">
                    <li class="nav-item">
                        <a class="nav-link active"><strong>THÔNG TIN SẢN PHẨM</strong></a>
                    </li>
                </ul>
                <div class="p-3 detailinfoproduct">
                    <h5><span><strong id="namecar">TÊN XE: </strong></span>{{ $product->name }}</h5>
                    <div class="product-description">
                        <p><i class="fa fa-caret-right"></i>
                            <span class="short-description"> {!! \Str::limit(strip_tags($product->description), 250)
                                !!}</span>
                            <span class="full-description" style="display:none;">{!! $product->description !!}</span>
                            <a href="javascript:void(0);" class="toggle-description">Xem thêm...</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Comments -->
        <div class="row mt-5">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Bình Luận</a>
                    </li>
                </ul>

                @if (auth()->check())
                    @if (auth()->user()->roles->contains('RoleName', 'comment'))
                        <!-- Người dùng bị cấm bình luận -->
                        <div class="alert alert-danger">
                            <p>Bạn đã bị cấm bình luận.</p>
                        </div>
                    @else
                        <!-- Hiển thị form bình luận -->
                        <form action="{{ route('product.comment', $product->getEncodedId()) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <textarea name="CommentText" class="form-control" rows="4"
                                    placeholder="Nhập bình luận của bạn..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi bình luận</button>
                        </form>
                    @endif
                @else
                    <!-- Hiển thị thông báo đăng nhập -->
                    <p>Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để bình luận.</p>
                @endif
            </div>
        </div>

        <!-- List Comments -->
        <div class="comments-section mt-4">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Danh sách đã bình luận</a>
                </li>
            </ul>

            @forelse ($comments as $comment)
                <div class="comment-item mb-3 p-3 border rounded">
                    <strong style="color: #ff0000">
                        {{ $comment->user->name ?? 'Người dùng ẩn danh' }}
                        <!-- Tên người dùng -->
                    </strong>
                    <small style="color: #837171">
                        - {{ \Carbon\Carbon::parse($comment->CreatedAt)->format('d/m/Y H:i') }}
                    </small>
                    <p style="color: #837171">{{ $comment->CommentText }}</p>
                </div>
            @empty
                <p>Chưa có bình luận nào. Hãy là người đầu tiên bình luận!</p>
            @endforelse
        </div>

    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggleButton = document.querySelector(".toggle-description");
            const shortDescription = document.querySelector(".short-description");
            const fullDescription = document.querySelector(".full-description");

            if (shortDescription.innerText.length < 250) {
                toggleButton.style.display = "none";
            }

            toggleButton.addEventListener("click", function() {
                if (fullDescription.style.display === "none") {
                    fullDescription.style.display = "inline";
                    toggleButton.textContent = "Thu gọn";
                } else {
                    fullDescription.style.display = "none";
                    toggleButton.textContent = "Xem thêm...";
                }
            });

            const increaseButton = document.getElementById("increaseQuantity");
            const decreaseButton = document.getElementById("decreaseQuantity");
            const quantityInput = document.getElementById("productQuantity");
            const cartQuantityInput = document.getElementById("cartQuantity");

            const maxQuantity = parseInt(quantityInput.dataset.max);
            let isInitialLoad = true;

            function updateButtonStates(quantity) {
                if (!isInitialLoad) {
                    if (quantity >= maxQuantity) {
                        alert("Số lượng đạt giới hạn tối đa!");
                    }
                    if (quantity <= 1) {
                        alert("Số lượng không được nhỏ hơn 1!");
                    }
                }
                increaseButton.disabled = (quantity >= maxQuantity);
                decreaseButton.disabled = (quantity <= 1);
            }

            updateButtonStates(parseInt(quantityInput.value));
            isInitialLoad = false;

            increaseButton.addEventListener("click", function() {
                let quantity = parseInt(quantityInput.value);
                if (quantity < maxQuantity) {
                    quantityInput.value = quantity + 1;
                    cartQuantityInput.value = quantityInput.value;
                    updateButtonStates(quantity + 1);
                }
            });

            decreaseButton.addEventListener("click", function() {
                let quantity = parseInt(quantityInput.value);
                if (quantity > 1) {
                    quantityInput.value = quantity - 1;
                    cartQuantityInput.value = quantityInput.value;
                    updateButtonStates(quantity - 1);
                }
            });

            quantityInput.addEventListener("input", function() {
                let quantity = parseInt(quantityInput.value);
                if (quantity > maxQuantity) {
                    quantityInput.value = maxQuantity;
                    alert("Số lượng sản phẩm đã đạt giới hạn tối đa!");
                } else if (quantity < 1 || isNaN(quantity)) {
                    quantityInput.value = 1;
                    alert("Số lượng sản phẩm không được nhỏ hơn 1!");
                }
                cartQuantityInput.value = quantityInput.value;
                updateButtonStates(parseInt(quantityInput.value));
            });

            // Hiệu ứng phóng to hình ảnh
            const zoomedImage = document.getElementById("zoomedImage");
            const magnifier = document.getElementById("magnifier");
            const zoomLevel = 2;

            if (zoomedImage && magnifier) {
                zoomedImage.addEventListener("mousemove", function(event) {
                    const {
                        left,
                        top,
                        width,
                        height
                    } = zoomedImage.getBoundingClientRect();
                    const x = event.clientX - left;
                    const y = event.clientY - top;

                    magnifier.style.backgroundImage = `url(${zoomedImage.src})`;
                    magnifier.style.backgroundSize = `${width * zoomLevel}px ${height * zoomLevel}px`;
                    magnifier.style.backgroundPosition =
                        `-${x * zoomLevel - magnifier.offsetWidth / 2}px -${y * zoomLevel - magnifier.offsetHeight / 2}px`;
                    magnifier.style.left = `${x - magnifier.offsetWidth / 2}px`;
                    magnifier.style.top = `${y - magnifier.offsetHeight / 2}px`;
                    magnifier.style.display = "block";
                });

                zoomedImage.addEventListener("mouseleave", function() {
                    magnifier.style.display = "none";
                });
            }
        });
    </script>

    </html>
@endsection
