document.addEventListener('DOMContentLoaded', function () {
    const quantityInputs = document.querySelectorAll('.quantity-input');
    const productItems = document.querySelectorAll('.product_item');
    const totalInput = document.getElementById('total');
    const alertBox = document.getElementById('alert-box');
    localStorage.clear();

    // Hàm lưu giỏ hàng vào localStorage
    function saveCartToLocalStorage(cartItems) {
        localStorage.setItem('cart', JSON.stringify(cartItems));
    }

    // Hàm lấy giỏ hàng từ localStorage
    function getCartFromLocalStorage() {
        const cart = localStorage.getItem('cart');
        return cart ? JSON.parse(cart) : [];
    }

    function addToCart(productId, price) {
        let cartItems = getCartFromLocalStorage();

        const productIndex = cartItems.findIndex(item => item.id === productId);
        if (productIndex !== -1) {
            // Nếu sản phẩm đã tồn tại, tăng số lượng
            cartItems[productIndex].quantity += 1;
            cartItems[productIndex].total = cartItems[productIndex].quantity * price;
        } else {
            // Nếu sản phẩm chưa tồn tại, thêm sản phẩm mới
            cartItems.push({
                id: productId,
                price: price,
                quantity: 1,
                total: price
            });
        }
        saveCartToLocalStorage(cartItems);
        updateGrandTotal();
    }
    // Hàm cập nhật tổng tiền từng sản phẩm
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

    // Xử lý khi nhấn nút thanh toán
    document.querySelector('.checkout').addEventListener('click', function (event) {
        event.preventDefault();
        quantityInputs.forEach((input, index) => {
            updateTotal(input, index);
        });
        updateGrandTotal();  // Đảm bảo tính tổng giỏ hàng trước khi gửi form
        this.closest('form').submit();
    });

    // Hàm cập nhật tổng tiền giỏ hàng
    function updateGrandTotal() {
        let grandTotal = 0;
        const cartItems = getCartFromLocalStorage();

        cartItems.forEach(function (item) {
            grandTotal += item.total;
        });

        if (totalInput) {
            totalInput.value = new Intl.NumberFormat('vi-VN').format(grandTotal) + '₫';
        }
    }

    document.querySelectorAll('.btn-add-to-cart').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const productId = this.getAttribute('data-id');
            const price = parseFloat(this.getAttribute('data-price'));

            addToCart(productId, price);
            alert('Đã thêm sản phẩm vào giỏ hàng');
            console.log("Product ID:", productId, "Price:", price);  // Now within scope
        });
    });
    
    // Hàm tải số lượng từ localStorage
    function loadQuantitiesFromLocalStorage() {
        const cartItems = getCartFromLocalStorage();
        quantityInputs.forEach((input, index) => {
            const productId = input.closest('tr').getAttribute('data-id');
            const cartItem = cartItems.find(item => item.id === productId);
            if (cartItem) {
                input.value = cartItem.quantity;
                updateTotal(input, index);
            }
        });
        updateGrandTotal();
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

    document.querySelectorAll('.increase-btn').forEach(button => {
        button.addEventListener('click', function () {
            let input = this.closest('td').querySelector('.quantity-input');
            increaseQuantity(input);
        });
    });

    document.querySelectorAll('.decrease-btn').forEach(button => {
        button.addEventListener('click', function () {
            let input = this.closest('td').querySelector('.quantity-input');
            decreaseQuantity(input);
        });
    });

    document.querySelectorAll('.quantity-input').forEach(input => {
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
        if (alertBox) {
            alertBox.textContent = 'Xóa sản phẩm thành công';
            alertBox.style.display = 'block';
            setTimeout(() => alertBox.style.display = 'none', 1000);
        }
    }

    document.querySelectorAll('.delete-btn').forEach(button => {
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

    loadQuantitiesFromLocalStorage();
});