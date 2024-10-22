document.addEventListener('DOMContentLoaded', function () {
    const quantityInputs = document.querySelectorAll('.quantity-input');
    const productItems = document.querySelectorAll('.product_item');
    const totalInput = document.getElementById('total');

    const alertBox = document.getElementById('alert-box');//hiển thị thông báo


    // Update lần lượt tổng tiền cho từng sản phẩm
    function updateTotal(input, index) {
        const price = parseFloat(input.getAttribute('data-price'));
        const quantity = parseInt(input.value);
        if (!isNaN(price) && !isNaN(quantity)) {
            const total = quantity * price;
            productItems[index].innerText = new Intl.NumberFormat('vi-VN').format(total) + '₫';

            // Cập nhật giá trị trong form hidden
            const hiddenQuantityInput = document.querySelector(`input[name="cartItems[${input.closest('tr').getAttribute('data-id')}][quantity]"]`);
            const hiddenPriceInput = document.querySelector(`input[name="cartItems[${input.closest('tr').getAttribute('data-id')}][price]"]`);

            if (hiddenQuantityInput && hiddenPriceInput) {
                hiddenQuantityInput.value = quantity;
                hiddenPriceInput.value = total;
            } else {
                console.error('Không tìm thấy hidden của text tính tổng tiền');
            }
        }
    }

    // Hàm tổng tiền
    function updateGrandTotal() {
        let grandTotal = 0;
        productItems.forEach(function (item) {
            const totalText = item.innerText.replace(/[₫.,]/g, '').trim();
            const total = parseFloat(totalText);
            if (!isNaN(total)) {
                grandTotal += total;
            }
        });

        // Cập nhật tổng tiền
        totalInput.value = new Intl.NumberFormat('vi-VN').format(grandTotal) + '₫';
    }

    // Tăng SL
    function increaseQuantity(input) {
        let quantity = parseInt(input.value);
        if (!isNaN(quantity)) {
            quantity += 1;
            input.value = quantity;
            const index = Array.from(quantityInputs).indexOf(input);
            updateTotal(input, index);
            updateGrandTotal();
        }
    }

    // Giảm SL
    function decreaseQuantity(input) {
        let quantity = parseInt(input.value);
        if (!isNaN(quantity) && quantity > 1) {
            quantity -= 1;
            input.value = quantity;
            const index = Array.from(quantityInputs).indexOf(input);
            updateTotal(input, index);
            updateGrandTotal();
        }
    }


    // Sự kiện nút tăng số lượng
    document.querySelectorAll('.increase-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            let input = this.closest('td').querySelector('.quantity-input');
            increaseQuantity(input);
        });
    });

    // Sự kiện nút giảm số lượng
    document.querySelectorAll('.decrease-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            let input = this.closest('td').querySelector('.quantity-input');
            decreaseQuantity(input);
        });
    });

    // Thêm sự kiện nhập trực tiếp vào ô số lượng
    document.querySelectorAll('.quantity-input').forEach(function (input) {
        input.addEventListener('input', function () {
            const index = Array.from(quantityInputs).indexOf(this);
            const value = parseInt(this.value);

            if (isNaN(value) || value < 1) {
                this.value = 1; // Đặt giá trị tối thiểu là 1
            }

            updateTotal(this, index);
            updateGrandTotal();
        });
    });
    
    function showDeleteAlert() {
        alertBox.textContent = 'Xóa sản phẩm thành công';
        alertBox.style.display = 'block';
        setTimeout(function () {
            alertBox.style.display = 'none';
        }, 100000);
    }

    // Xóa sản phẩm và hiển thị alert
    document.querySelectorAll('.delete-btn').forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault(); // Ngăn chặn form gửi đi ngay lập tức
            const form = this.closest('form');
            const confirmation = confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?');
            if (confirmation) {
                showDeleteAlert();
                form.submit();
            }
        });
    });


    // Cập nhật tổng tiền khi trang tải
    quantityInputs.forEach((input, index) => {
        updateTotal(input, index);
    });

    updateGrandTotal();
});
