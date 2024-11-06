<!-- Đảm bảo bạn đã bao gồm jQuery trong trang -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        // Khi nhấn vào biểu tượng trái tim
        $(document).on('click', '.favorite-btn', function () {
            var productId = $(this).data('product-id'); // Lấy ID sản phẩm
            var icon = $(this); // Lưu biểu tượng để thay đổi sau này
            var isFavorited = icon.hasClass('fas'); // Kiểm tra xem sản phẩm đã được yêu thích chưa
            // Đặt URL dựa trên trạng thái yêu thích
            var url = isFavorited ? '/favorites/remove/' + productId : '/favorites/add/' + productId;
            $.ajax({
                url: url, // URL đến route của bạn
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}' // Thêm token CSRF để bảo vệ
                },
                success: function (response) {
                    // Cập nhật giao diện sau khi thêm hoặc xóa thành công
                    icon.toggleClass('fas fa-heart far fa-heart'); // Chuyển đổi biểu tượng
                    var message = isFavorited ? 'Sản phẩm đã được xóa khỏi danh sách yêu thích!' : 'Sản phẩm đã được thêm vào danh sách yêu thích!';
                    alert(message);
                },
                error: function (xhr) {
                    if (xhr.status === 401) {
                        // Nếu mã trạng thái là 401, chuyển hướng người dùng đến trang đăng nhập
                        window.location.href = '/login'; // Đường dẫn đến trang đăng nhập của bạn
                    } else {
                        alert('Có lỗi xảy ra. Vui lòng thử lại sau.');
                    }
                }
            });
        });
    });
</script>