document.addEventListener('DOMContentLoaded', function () {
    const quantityInputs = document.querySelectorAll('.quantity-input');
    const productItems = document.querySelectorAll('.product_item');
    const totalInput = document.getElementById('total');
    const alertBox = document.getElementById('alert-box');
    localStorage.clear();

    function saveCartToLocalStorage(cartItems) {
        localStorage.setItem('cart', JSON.stringify(cartItems));
    }

    function getCartFromLocalStorage() {
        const cart = localStorage.getItem('cart');
        return cart ? JSON.parse(cart) : [];
    }

    function updateTotal(input, index) {
        const price = parseFloat(input.getAttribute('data-price'));
        const quantity = parseInt(input.value);

        if (!isNaN(price) && !isNaN(quantity)) {
            const total = quantity * price;
            productItems[index].innerText = new Intl.NumberFormat('vi-VN').format(total) + '₫';

            const productId = input.closest('tr').getAttribute('data-id');

            let cartItems = getCartFromLocalStorage();

            const productIndex = cartItems.findIndex(item => item.id === productId);
            if (productIndex !== -1) {
                cartItems[productIndex].quantity = quantity;
                cartItems[productIndex].total = total;
            } else {
                cartItems.push({
                    id: productId,
                    price: price,
                    quantity: quantity,
                    total: total
                });
            }
            saveCartToLocalStorage(cartItems);
            const hiddenQuantityInput = document.querySelector(`input[name="cartItems[${productId}][quantity]"]`);
            const hiddenPriceInput = document.querySelector(`input[name="cartItems[${productId}][price]"]`);

            if (hiddenQuantityInput && hiddenPriceInput) {
                hiddenQuantityInput.value = quantity;
                hiddenPriceInput.value = total;
            } else {
                console.error('Hidden input không tìm thấy.');
            }
        }
    }

    document.querySelector('.checkout').addEventListener('click', function (event) {
        event.preventDefault();
        quantityInputs.forEach((input, index) => {
            updateTotal(input, index);
        });
        this.closest('form').submit();
    });
    function updateGrandTotal() {
        let grandTotal = 0;
        const cartItems = getCartFromLocalStorage();

        cartItems.forEach(function (item) {
            grandTotal += item.total;
        });

        totalInput.value = new Intl.NumberFormat('vi-VN').format(grandTotal) + '₫';
    }

    // Tăng số lượng
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

    // Giảm số lượng
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

    document.querySelectorAll('.increase-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            let input = this.closest('td').querySelector('.quantity-input');
            increaseQuantity(input);
        });
    });

    document.querySelectorAll('.decrease-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            let input = this.closest('td').querySelector('.quantity-input');
            decreaseQuantity(input);
        });
    });

    document.querySelectorAll('.quantity-input').forEach(function (input) {
        input.addEventListener('input', function () {
            const index = Array.from(quantityInputs).indexOf(this);
            const value = parseInt(this.value);

            if (isNaN(value) || value < 1) {
                this.value = 1;
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
        }, 1000);
    }

    document.querySelectorAll('.delete-btn').forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const form = this.closest('form');
            const confirmation = confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?');
            if (confirmation) {
                const productId = form.closest('tr').getAttribute('data-id');

                let cartItems = getCartFromLocalStorage();
                cartItems = cartItems.filter(item => item.id !== productId);
                saveCartToLocalStorage(cartItems);

                showDeleteAlert();
                form.submit();
            }
        });
    });

    quantityInputs.forEach((input, index) => {
        updateTotal(input, index);
    });

    updateGrandTotal();
});




