<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DETAIL - (TÊN SẢN PHẨM)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/detail.css') }}">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <!-- Product Image -->
            <div class="col-md-6">
                <!-- Main product image -->
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('images/' . $product->image_url . '.jpg') }}" class="d-block w-100"
                                alt="{{ $product->name }}">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/lambo.jpg') }}" class="d-block w-100" alt="Image 2">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/banner1.jpg') }}" class="d-block w-100" alt="Image 3">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <!-- Thumbnails below the carousel -->
                <div class="mt-3 d-flex justify-content-center">
                    <img src="{{ asset('images/56.jpg') }}" class="img-thumbnail me-2" style="width: 100px;"
                        data-bs-target="#productCarousel" data-bs-slide-to="0" alt="Thumbnail 1">
                    <img src="{{ asset('images/lambo.jpg') }}" class="img-thumbnail me-2" style="width: 100px;"
                        data-bs-target="#productCarousel" data-bs-slide-to="1" alt="Thumbnail 2">
                    <img src="{{ asset('images/banner1.jpg') }}" class="img-thumbnail" style="width: 100px;"
                        data-bs-target="#productCarousel" data-bs-slide-to="2" alt="Thumbnail 3">
                </div>
            </div>

            <!-- Product Information -->
            <div class="col-md-6">
                <h3>{{ $product->name }}</h3>
                <p>Thương hiệu: Đang cập nhật | Tình trạng: <span class="text-success">Còn hàng</span></p>
                <h4 class="text-danger">{{ number_format($product->price, 0, ',', '.') }} VND</h4>
                <div class="input-group mb-3">
                    <button class="btn btn-outline-secondary" type="button">-</button>
                    <input type="text" class="form-control text-center" value="1" style="max-width: 60px;">
                    <button class="btn btn-outline-secondary" type="button">+</button>
                </div>
                <button class="btn btn-danger mb-3">Đặt hàng</button>
                <p>{{ $product->description }}</p>
                <div class="d-flex">
                    <span class="me-2">Chia sẻ: </span>
                    <a href="#" class="me-2"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="me-2"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="me-2"><i class="bi bi-google"></i></a>
                </div>
            </div>
        </div>

        <!-- Product Details and Tabs -->
        <div class="row mt-5">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Thông tin sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Chính sách</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Đánh giá sản phẩm</a>
                    </li>
                </ul>
                <div class="p-3">
                    <h5>{{ $product->name}}</h5>
                    <ul>
                        <li>{{ $product->description }}</li>
                    </ul>
                </div>

                <!-- Comment Form -->
                <div class="mt-5">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h4>Đánh giá sản phẩm</h4>

                    @guest
                        <p>Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để bình luận</p>
                    @else
                        @if ($isBannedFromCommenting)
                            <p class="text-danger">Bạn không có quyền bình luận về sản phẩm này.</p>
                        @else
                            <form action="{{ route('product.comment', $productId) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="commentText" class="form-label">Viết bình luận của bạn:</label>
                                    <textarea class="form-control" id="commentText" name="commentText" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Gửi bình luận</button>
                            </form>
                        @endif
                    @endguest
                </div>

                <!-- Display comments -->
                <div class="mt-4">
                    @if ($comments->isEmpty())
                        <p>Chưa có bình luận nào</p>
                    @else
                        <h5>Phản hồi từ khách hàng</h5>
                        @foreach ($comments as $comment)
                            <div class="border rounded p-3 mb-3">
                                <strong>{{ $comment->username }}</strong>
                                <p>{{ $comment->CommentText }}</p>
                                <small
                                    class="text-muted">{{ \Carbon\Carbon::parse($comment->CreatedAt)->format('d/m/Y H:i') }}</small>
                            </div>
                        @endforeach
                    @endif
                </div>

            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>