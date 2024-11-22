@extends('header_footer')
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DETAIL - {{ $product->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/detail.css') }}">
</head>

<body>
    @section('main')
    <div class="container mt-5">
        <div class="row">
            <!-- Product Image -->
            <div class="col-md-6">
                <!-- Main product image -->
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('images/' . $product->image_url . '.jpg') }}" class="d-block"
                                alt="{{ $product->name }}">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/lambo.jpg') }}" class="d-block w-100"
                                alt="Nhớt Castrol Magnatec 10W40 - 2">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/banner1.jpg') }}" class="d-block w-100"
                                alt="Nhớt Castrol Magnatec 10W40 - 3">
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
                        data-bs-target="#productCarousel" data-bs-slide-to="0" alt="Nhớt Castrol Magnatec 10W40">
                    <img src="{{ asset('images/lambo.jpg') }}" class="img-thumbnail me-2" style="width: 100px;"
                        data-bs-target="#productCarousel" data-bs-slide-to="1" alt="Nhớt Castrol Magnatec 10W40 - 2">
                    <img src="{{ asset('images/banner1.jpg') }}" class="img-thumbnail" style="width: 100px;"
                        data-bs-target="#productCarousel" data-bs-slide-to="2" alt="Nhớt Castrol Magnatec 10W40 - 3">
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
                {{-- <button class="btn btn-danger mb-3">Đặt hàng</button> --}}
                <form action="{{ route('cart.add', $product->ProductId) }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->ProductId }}">

                    @if (auth()->check())
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    @endif
                    <button class="btn-add-to-cart" data-id="{{ $product->ProductId }}"
                        data-price="{{ $product->price }}">Thêm vào giỏ hàng</button>
                </form>
                <p>{{ $product->description }}</p>
                <div class="d-flex">
                    <span class="me-2">Chia sẻ: </span>
                    <a href="#" class="me-2"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="me-2"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="me-2"><i class="bi bi-google"></i></a>
                </div>
            </div>
        </div>
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
                    <h5>{{ $product->name }}</h5>
                    <ul>
                        <li>{{ $product->description }}</li>
                    </ul>
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
                        <form action="{{ route('product.comment', $product->ProductId) }}" method="POST">
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

</html>
@endsection