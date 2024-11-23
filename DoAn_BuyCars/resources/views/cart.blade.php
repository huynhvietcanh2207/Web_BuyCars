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
        </div>c
    </div>
    <div class="container my-5">
        <div class="cart">
            <div class="table-responsive">
                <div class="cart-table-wrapper">
                    <table class="cart-table table text-center" id="cartTable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Ảnh sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Đơn giá</th>
                                <th style="width: 200px">Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody id="cartItemsBody">
                            @if ($cartItems->count() > 0)
                                @foreach ($cartItems as $item)
                                    <tr class="cart-item" data-id="{{ $item->CartItemId }}">
                                        <td class="checkbox"><input type="checkbox" class="remove-item"
                                                data-id="{{ $item->CartItemId }}"></td>
                                        <td>
                                            <img src="{{ asset($item->product->image_url) }}" alt="{{ $item->product->name }}"
                                                class="img-fluid" width="100">
                                        </td>
                                        <td>{{ $item->product->name }}</td>
                                        <td class="product-price">
                                            {{ number_format($item->product->price, 0, ',', '.') }}₫
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-secondary quantity-btn decrease-btn">-</button>
                                            <input type="text" class="form-control d-inline text-center quantity-input"
                                                style="width: 60px;" value="{{ $item->quantity }}"
                                                data-price="{{ $item->product->price }}" min="1"
                                                data-max="{{ $item->product->quantity }}">
                                            <button class="btn btn-outline-secondary quantity-btn increase-btn">+</button>
                                        </td>
                                        <td class="product_item">
                                            {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}₫
                                        </td>
                                        <td>
                                            <form action="{{ route('cart.destroy', $item->CartItemId) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-outline-danger delete-btn">🗑️</button>
                                                <div id="alert-box"
                                                    style="display:none; position:fixed; top:20px; right:20px; z-index: 1050;"
                                                    class="alert alert-success" role="alert"></div>
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
            </div>
            <div id="checkall"><input type="checkbox" id="selectAll" class="me-2" value="">Chọn tất cả sản phẩm
            </div>
            <form>
                <div class="cart-footer d-flex justify-content-between align-items-center mt-4">
                    <button type="button" class="btn btn-outline-danger continue-shopping"
                        onclick="window.location.href='{{ route('index') }}'">
                        TIẾP TỤC MUA HÀNG
                    </button>
                    <button type="button" id="delete-selected" class="btn btn-danger">Xóa các mục đã chọn</button>
                    <div class="total text-end">
                        <label for="total" class="text-dark">Tổng tiền thanh toán: </label>
                        <input type="text" id="total" class="form-control d-inline" readonly style="width: 150px;"><br>
                        @if (auth()->user()->roles->contains('RoleName', 'payment'))
                            <div class="alert alert-warning text-center">
                                Bạn đã bị cấm thanh toán
                            </div>
                        @else
                            <button type="submit" class="btn btn-danger checkout">TIẾN HÀNH THANH TOÁN</button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
                    
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            });

            $('#selectAll').on('change', function () {
                let isChecked = $(this).prop('checked');
                $('.remove-item').prop('checked', isChecked);
                updateTotal();
            });

            $('.quantity-btn').on('click', function (e) {
                e.preventDefault();
                const row = $(this).closest('tr');
                const cartItemId = row.data('id');
                const quantityInput = row.find('.quantity-input');
                let quantity = parseInt(quantityInput.val());

                // if ($(this).hasClass('increase-btn')) {
                //     quantity++;
                // } else if ($(this).hasClass('decrease-btn') && quantity > 1) {
                //     quantity--;
                // }

                if ($(this).hasClass('increase-btn') && quantity < quantityInput.data('max')) {
                    quantity++;
                } else if ($(this).hasClass('decrease-btn') && quantity > 1) {
                    quantity--;
                }
                quantityInput.val(quantity);
                updateButtonStates(quantityInput);
                updateCart(cartItemId, quantity);
                updateTotal();
            });

            $('#delete-selected').on('click', function () {
                let selectedItems = [];
                $('.remove-item:checked').each(function () {
                    selectedItems.push($(this).data('id'));
                });

                if (selectedItems.length > 0) {
                    if (confirm('Bạn có chắc chắn muốn xóa các sản phẩm đã chọn không?')) {
                        $.ajax({
                            url: "{{ route('cart.chooseDelete') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                cartItemIds: selectedItems
                            },
                            success: function (response) {
                                selectedItems.forEach(id => {
                                    $('tr[data-id="' + id + '"]').remove();
                                });
                                updateTotal();
                            },
                            error: function (xhr) {
                                alert('Đã xảy ra lỗi khi xóa. Vui lòng thử lại.');
                                console.error(xhr.responseText);
                            }
                        });
                    }
                } else {
                    alert('Vui lòng chọn ít nhất một sản phẩm để xóa.');
                }
            });

            $('.delete-btn').on('click', function (e) {
                e.preventDefault();
                if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')) {
                    $(this).closest('form').submit();
                }
            });

            function updateCart(cartItemId, quantity) {
                $.ajax({
                    url: "{{ route('cart.update') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        cartItemId: cartItemId,
                        quantity: quantity
                    },
                    success: function (response) {
                        const productRow = $('tr[data-id="' + cartItemId + '"]');
                        productRow.find('.product_item').text(response.updatedItemPrice);
                        updateTotal();
                    },
                    error: function (xhr) {
                        alert('Đã xảy ra lỗi. Vui lòng thử lại.');
                        console.error(xhr.responseText);
                    }
                });
            }

            function updateTotal() {
                let total = 0;
                const selectedItems = $('.remove-item:checked');

                //Tổng giá theo sản phẩm được check
                if (selectedItems.length > 0) {
                    selectedItems.each(function () {
                        const row = $(this).closest('tr');
                        const priceText = row.find('.product_item').text();
                        const price = parseFloat(priceText.replace(/\./g, '').replace('₫', '')
                            .replace(',',
                                '.'));
                        total += price;
                    });
                } else {
                    //Tổng giá theo không có sản phẩm nào được check cả
                    $('.product_item').each(function () {
                        const priceText = $(this).text();
                        const price = parseFloat(priceText.replace(/\./g, '').replace('₫', '')
                            .replace(',',
                                '.'));
                        total += price;
                    });
                }
                $('#total').val(total.toLocaleString('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }));

                //Nút button hiển thị ra khi có ít nhất 1 sản phẩm được chọn
                if (selectedItems.length > 0) {
                    $('#delete-selected').show();
                    $('#selectAll').show();
                    if ($('.cart-item').length > 1) {
                        $('#checkall').show();
                    }
                } else {
                    $('#delete-selected').hide();
                    $('#selectAll').hide();
                    $('#checkall').hide();
                }
            }
            updateTotal()

            //Hàm checkButton
            function updateButtonStates(quantityInput) {
                const quantity = parseInt(quantityInput.val());
                const maxQuantity = parseInt(quantityInput.data('max'));
                const increaseBtn = quantityInput.siblings('.increase-btn');
                const decreaseBtn = quantityInput.siblings('.decrease-btn');

                increaseBtn.prop('disabled', quantity >= maxQuantity);
                decreaseBtn.prop('disabled', quantity <= 1);
            }

            $('.quantity-input').each(function () {
                updateButtonStates($(this));
            });

            $('.quantity-input').on('input', function () {
                const quantityInput = $(this);
                let quantity = parseInt(quantityInput.val());
                const maxQuantity = parseInt(quantityInput.data('max'));

                if (quantity > maxQuantity) {
                    quantity = maxQuantity;
                } else if (quantity < 1 || isNaN(quantity)) {
                    quantity = 1;
                }

                quantityInput.val(quantity);
                updateButtonStates(quantityInput); // Update button states
                updateCart(quantityInput.closest('tr').data('id'), quantity);
                updateTotal();
            });
        });
    </script>
</body>

</html>
@endsection