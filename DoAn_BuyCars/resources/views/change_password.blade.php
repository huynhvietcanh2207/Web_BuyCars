@extends('header_footer')

<style>
    .container {
        padding: 30px 0;
    }

    .card {
        border: none;
        border-radius: 10px;
    }

    .card-body {
        background: #f9f9f9;
        padding: 30px;
        border-radius: 8px;
    }

    h3.card-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        font-weight: bold;
        padding: 10px;
        font-size: 1rem;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .form-group {
        position: relative;
    }

    .form-control {
        padding-right: 40px; /* Tăng padding phải để có chỗ cho biểu tượng mắt */
    }

    .input-group {
        position: relative;
    }

    .input-group-append {
        position: absolute;
        right: 10px; /* Đặt khoảng cách từ bên phải */
        top: 50%; /* Đặt ở giữa chiều cao của input */
        transform: translateY(-50%); /* Dịch chuyển lên một nửa chiều cao của chính nó */
        cursor: pointer;
        color: #888;
        font-size: 1.2rem; /* Kích thước biểu tượng */
    }
</style>

@section('main')

   <!-- Thông báo alert cho error -->
   @if (session()->has('error'))
            <script>
                window.onload = function() {
                    alert("{{ session('error') }}");
                }
            </script>
        @endif
<div class="container mt-5">
    <div class="card shadow-sm mx-auto" style="max-width: 500px; border-radius: 8px;">
        <div class="card-body p-4">
            <h3 class="card-title text-center mb-4">Đổi Mật Khẩu</h3>

            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <div class="form-group mb-3">
                    <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                    <div class="input-group">
                        <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Nhập mật khẩu hiện tại" required>
                        <div class="input-group-append">
                            <i class="fas fa-eye toggle-password" onclick="an_hienMK('current_password')"></i>
                        </div>
                    </div>
                    @error('current_password')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="new_password" class="form-label">Mật khẩu mới</label>
                    <div class="input-group">
                        <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Nhập mật khẩu mới" required>
                        <div class="input-group-append">
                            <i class="fas fa-eye toggle-password" onclick="an_hienMK('new_password')"></i>
                        </div>
                    </div>
                    @error('new_password')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="new_password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                    <div class="input-group">
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" placeholder="Xác nhận mật khẩu mới" required>
                        <div class="input-group-append">
                            <i class="fas fa-eye toggle-password" onclick="an_hienMK('new_password_confirmation')"></i>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Đổi Mật Khẩu</button>
            </form>
        </div>
    </div>
</div>

<script>
    function an_hienMK(id) {
        const input = document.getElementById(id);
        const icon = input.nextElementSibling;

        if (input.type === "password") {
            input.type = "text";
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = "password";
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>
@endsection
