@extends('header_footer')

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/cart.css') }}">
</head>

<body>
    @section('main')
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
                <table class="cart-table table text-center" id="cartTable">
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
                        @php
                        $cartItems = session()->get('cart.items', []);
                        @endphp
                        @if (count($cartItems) > 0)
                        @foreach ($cartItems as $productId => $item)
                        <tr class="cart-item" data-id="{{ $productId }}">
                            <td>
                                <img src="{{ asset('images/' . $item['image_url']) }}" name="tensp" alt="{{ $item['name'] }}" class="img-fluid" width="100">
                            </td>
                            <td>{{ $item['name'] }}</td>
                            <td class="product-price">
                                {{ number_format($item['price'], 0, ',', '.') }}₫
                            </td>
                            <td>
                                <button class="btn btn-outline-secondary quantity-btn decrease-btn">-</button>
                                <input type="number" class="form-control d-inline text-center quantity-input" style="width: 60px;" value="{{ $item['quantity'] }}" min="1">
                                <button class="btn btn-outline-secondary quantity-btn increase-btn">+</button>
                            </td>
                            <td class="product_item" data-item-id="{{ $productId }}">{{ number_format($item['quantity'] * $item['price'], 0, ',', '.') }}₫</td>
                            <td>{{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}</td>
                            <td>
                                <form action="{{ route('cart.destroy', $productId) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-outline-danger delete-btn">🗑️</button>
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
                </table>
            </div>

            <!-- Total Price -->
            <div class="total text-end mt-3">
                <label for="total" class="text-dark">Tổng tiền thanh toán: </label>
                <input type="text" id="total" class="form-control d-inline" readonly value="{{ number_format(array_sum(array_map(function($item) {
                return $item['quantity'] * $item['price'];
            }, $cartItems)), 0, ',', '.') }}₫" style="width: 200px;">
            </div>

            <!-- Payment form -->
            <form action="{{ url('/vnpay_payment') }}" method="POST" class="text-end mt-3">
                @csrf
                <input type="hidden" name="total" value="{{ array_sum(array_map(function($item) {
                return $item['quantity'] * $item['price'];
            }, $cartItems)) }}">
                <button type="submit" name="redirect" class="btn btn-danger checkout-btn">Thanh toán</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function updateTotal() {
                let totalPrice = 0;
                $('.cart-item').each(function() {
                    const price = parseFloat($(this).find('.product-price').text().replace('₫', '').replace(/\./g, '').trim());
                    const quantity = parseInt($(this).find('.quantity-input').val());
                    const itemTotal = price * quantity;

                    // Làm tròn giá trị thành tiền
                    totalPrice += itemTotal;
                    $(this).find('.product_item').text(numberWithCommas(itemTotal.toFixed(0)) + '₫');
                });
                $('#total').val(numberWithCommas(totalPrice.toFixed(0)) + '₫');
            }

            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            function updateCart(productId, quantity) {
                $.ajax({
                    url: '{{ route("cart.update") }}', // Ensure this route exists in your web.php
                    method: 'POST',
                    data: {
                        cartItems: JSON.stringify({
                            [productId]: {
                                quantity: quantity
                            }
                        }),
                        _token: '{{ csrf_token() }}', // CSRF token for security
                    },
                    success: function(response) {
                        console.log(response.message); // Log response message for debugging
                    },
                    error: function(xhr) {
                        console.error('Error updating cart:', xhr);
                    }
                });
            }

            // Event listeners for quantity changes
            $('.quantity-input').on('change', function() {
                const input = $(this);
                const productId = input.closest('.cart-item').data('id');
                const quantity = parseInt(input.val());
                updateTotal();
                updateCart(productId, quantity); // Call to update the cart on the server
            });

            $('.increase-btn').on('click', function() {
                const input = $(this).siblings('.quantity-input');
                input.val(parseInt(input.val()) + 1);
                const productId = input.closest('.cart-item').data('id');
                updateTotal();
                updateCart(productId, parseInt(input.val())); // Call to update the cart on the server
            });

            $('.decrease-btn').on('click', function() {
                const input = $(this).siblings('.quantity-input');
                if (parseInt(input.val()) > 1) {
                    input.val(parseInt(input.val()) - 1);
                    const productId = input.closest('.cart-item').data('id');
                    updateTotal();
                    updateCart(productId, parseInt(input.val())); // Call to update the cart on the server
                }
            });

            updateTotal(); // Initial total calculation
        });
    </script>


</body>

</html>
@endsection