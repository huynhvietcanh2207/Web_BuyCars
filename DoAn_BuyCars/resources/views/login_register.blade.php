<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="login.css">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

    <title>Document</title>
</head>

<body>
    @if(session()->has('success'))
    <script>
        window.onload = function() {
            alert("{{ session('success') }}");
        }
    </script>
    @endif

    @if(session()->has('error'))
    <script>
        window.onload = function() {
            alert("{{ session('error') }}");
        }
    </script>
    @endif


    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <h1>Tạo Tài Khoản</h1>

                <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required>
                @error('name', 'store')
                <span class="error-message">{{ $message }}</span>
                @enderror

                <input type="text" name="phone_number" placeholder="Phone" value="{{ old('phone_number') }}" required>
                @error('phone_number', 'store')
                <span class="error-message">{{ $message }}</span>
                @enderror

                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                @error('email', 'store')
                <span class="error-message">{{ $message }}</span>
                @enderror

                <div class="password-container">
                    <input type="password" name="password" id="passwordSignup" placeholder="Password" required>
                    <i class="fas fa-eye" id="eyeSignup" onclick="togglePassword('passwordSignup', 'eyeSignup')"></i>
                </div>
                @error('password', 'store')
                <span class="error-message">{{ $message }}</span>
                @enderror

                <div class="password-container">
                    <input type="password" name="password_confirmation" id="passwordConfirm" placeholder="Confirm Password" required>
                    <i class="fas fa-eye" id="eyeConfirm" onclick="togglePassword('passwordConfirm', 'eyeConfirm')"></i>
                </div>


                @error('password_confirmation', 'store')
                <span class="error-message">{{ $message }}</span>
                @enderror

                <button>Sign Up</button>
            </form>

        </div>
        <div class="form-container sign-in">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <h1>Đăng Nhập</h1>
                @if ($errors->any())
                <div class="alert alert-danger error-message">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
                @error('email', 'login')
                <span class="error-message">{{ $message }}</span>
                @enderror

                <div class="password-container">
                    <input type="password" name="password" id="passwordLogin" placeholder="Password" required>
                    <i class="fas fa-eye" id="eyeLogin" onclick="togglePassword('passwordLogin', 'eyeLogin')"></i>
                </div>
                @error('password', 'login')
                <span class="error-message">{{ $message }}</span>
                @enderror

                <a href="#">Forget Your Password?</a>
                <button>Sign In</button>
            </form>
        </div>

        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Chào mừng trở lại!</h1>
                    <p>Nhập thông tin cá nhân của bạn để sử dụng tất cả các tính năng của trang web!!</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Chào, Bạn!</h1>
                    <p>Đăng ký thông tin cá nhân của bạn để sử dụng tất cả các tính năng của trang web!!</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="login.js"></script>
    <script src="{{ asset('js/login.js') }}"></script>
    <script>
        // Hàm toggle để hiển thị/ẩn mật khẩu
        // Hàm toggle để hiển thị/ẩn mật khẩu
        function togglePassword(inputId, iconId) {
            var input = document.querySelector(`#${inputId}`);
            var icon = document.querySelector(`#${iconId}`);

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
</body>

</html>
<style>
    .error-message {
        color: red;
        font-size: 10px;
        margin-top: 5px;
        display: block;
    }

    .password-container {
        position: relative;
        width: 100%;
    }

    .password-container i {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
    }
</style>