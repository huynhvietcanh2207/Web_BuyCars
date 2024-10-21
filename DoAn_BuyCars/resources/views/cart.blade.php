<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/cart.css">
</head>

<body>
    <div class="banner">
        <div class="cart-header text-center">
            <img src="{{ asset('images/banner1.jpg') }}" alt="Banner">
            <h1>GIỎ HÀNG</h1>
            <p><span id="hightlight">Trang chủ ></span> Giỏ hàng</p>
        </div>
    </div>
    <div class="container my-5">
        <div class="cart">
            <div class="table-responsive">
                <div class="cart-table-wrapper" style="max-height: 300px; overflow-y: auto;">
                    <table class="cart-table table table-bordered text-center" id="cartTable">
                        <thead>
                            <tr>
                                <th>Ảnh sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Cập nhật lúc</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody id="cartItemsBody">
                            @if ($cartItems->count() > 0)
                                @foreach ($cartItems as $item)
                                    <tr class="cart-item" data-id="{{ $item->CartItemId }}"
                                        data-updated-at="{{ $item->updated_at }}">
                                        <td>
                                            @if (file_exists(public_path('images/' . $item->product->image_url . '.png')))
                                                <img src="{{ asset('images/' . $item->product->image_url . '.png') }}"
                                                    alt="{{ $item->product->name }}" class="img-fluid" width="100">
                                            @elseif(file_exists(public_path('images/' . $item->product->image_url . '.jpg')))
                                                <img src="{{ asset('images/' . $item->product->image_url . '.jpg') }}"
                                                    alt="{{ $item->product->name }}" class="img-fluid" width="100">
                                            @else
                                                <img src="{{ asset('images/default.png') }}"
                                                    alt="{{ $item->product->name }}" class="img-fluid" width="100">
                                            @endif
                                        </td>
                                        <td>{{ $item->product->name }}</td>
                                        <td class="product-price">
                                            {{ number_format($item->product->price, 0, ',', '.') }}₫</td>
                                        <td>
                                            <button
                                                class="btn btn-outline-secondary quantity-btn decrease-btn">-</button>
                                            <input type="text"
                                                class="form-control d-inline text-center quantity-input"
                                                style="width: 60px;" value="{{ $item->quantity }}"
                                                data-price="{{ $item->product->price }}" min="1">
                                            <button
                                                class="btn btn-outline-secondary quantity-btn increase-btn">+</button>
                                        </td>
                                        <td class="product_item">{{ number_format($item->price, 0, ',', '.') }}₫</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td>
                                            <form action="{{ route('cart.destroy', $item->CartItemId) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-outline-danger delete-btn">🗑️</button>
                                                <!-- Thêm thông báo thành công ở đây -->
                                                {{-- @if (session('success'))
                                                    <div class="alert alert-success">
                                                        {{ session('success') }}
                                                    </div>
                                                @endif --}}
                                                <div id="alert-box" style="display:none; position:fixed; top:20px; right:20px; z-index: 1050;" class="alert alert-success" role="alert"></div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">Giỏ hàng của bạn hiện đang trống.</td>
                                </tr>
                            @endif
                        </tbody>

                        <!-- Phân trang -->
                        @if (!empty($cartItems) && $cartItems->count() > 0)
                            <div id="pagination" class="d-flex justify-content-center mt-3">
                                {{ $cartItems->links('pagination::bootstrap-4') }}
                            </div>
                        @endif
                    </table>
                </div>
            </div>

            <!-- Phân trang -->
            @if ($cartItems->count() > 0)
                <div id="pagination" class="d-flex justify-content-center mt-3">
                    {{ $cartItems->links('pagination::bootstrap-4') }}
                </div>
            @endif

            <!-- Form để cập nhật số lượng và tổng tiền -->
            <form action="{{ route('cart.update') }}" method="POST">
                @csrf
                @method('PUT')
                @foreach ($cartItems as $item)
                    <input type="hidden" name="cartItems[{{ $item->CartItemId }}][quantity]"
                        value="{{ $item->quantity }}">
                    <input type="hidden" name="cartItems[{{ $item->CartItemId }}][price]"
                        value="{{ $item->price }}">
                @endforeach

                <div class="cart-footer d-flex justify-content-between align-items-center mt-4">
                    <button class="btn btn-outline-danger continue-shopping">TIẾP TỤC MUA HÀNG</button>

                    <div class="total text-end">
                        <label for="total">Tổng tiền thanh toán</label>
                        <input type="text" id="total" class="form-control d-inline" readonly
                            style="width: 150px;">
                        <button type="submit" class="btn btn-danger checkout">TIẾN HÀNH THANH TOÁN</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('/js/cart.js') }}"></script>
</body>

</html>
