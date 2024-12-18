@extends('header_footer')

@section('title', 'Hồ Sơ Của Tôi')

@section('main')

<div class="profile-container">
    <!-- Hiển thị thông báo thành công -->
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Hiển thị thông báo lỗi -->
    @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Hiển thị thông báo lỗi -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <h2 class="profile-header">Hồ Sơ Của Tôi</h2>
    <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
    <hr>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="profile-sidebar">
            <a href="{{ route('password.change') }}">Đổi mật khẩu</a>
            <a href="{{ route('account.profile') }}">Cập nhật thông tin</a>
            <a href="#">Lịch sử đơn hàng</a>
        </div>

        <!-- Container bao quanh phần hồ sơ -->
        <div class="container-fluid profile-main d-flex">
            <!-- Profile Form -->
            <div class="profile-form-container flex-fill">
                <form action="{{ route('account.updateAccount') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="profile-form d-flex">
                        <div class="flex-fill">
                            <div class="form-group">
                                <label>Tên</label>
                                <input type="text" name="name" class="form-control" placeholder="Nhập tên của bạn"
                                    value="{{ old('name', $user->name) }}">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <p>
                                    @php
                                    $emailParts = explode('@', $user->email);
                                    $visiblePart = substr($emailParts[0], 0, 2);
                                    $hiddenPart = str_repeat('*', strlen($emailParts[0]) - 2);
                                    @endphp
                                    {{ $visiblePart . $hiddenPart . '@' . $emailParts[1] }}
                                </p>
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <p id="phone-display">
                                    {{ isset($user->phone_number) && strlen($user->phone_number) >= 2 ? str_repeat('*', strlen($user->phone_number) - 2) . substr($user->phone_number, -2) : str_repeat('*', 10) }}
                                    <a href="#" onclick="editPhone()">Thay đổi</a>
                                </p>
                                <input type="text" id="phone-input" name="phone_number" class="form-control d-none"
                                    placeholder="Nhập số điện thoại mới"
                                    value="{{ old('phone_number', $user->phone_number) }}">
                            </div>
                            <div class="form-group">
                                <label>Giới tính</label>
                                <div>
                                    <input type="radio" name="gender" value="male"
                                        {{ $user->gender === 'male' ? 'checked' : '' }}> Nam
                                    <input type="radio" name="gender" value="female"
                                        {{ $user->gender === 'female' ? 'checked' : '' }}> Nữ
                                    <input type="radio" name="gender" value="other"
                                        {{ $user->gender === 'other' ? 'checked' : '' }}> Khác
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Ngày sinh</label>
                                <p id="birthdate-display">
                                    @php
                                    $birthdateParts = explode('/', $user->birthdate ?? '');
                                    $day = isset($birthdateParts[0]) ? '**' : '**';
                                    $month = isset($birthdateParts[1]) ? $birthdateParts[1] : '**';
                                    $year = isset($birthdateParts[2]) ? substr($birthdateParts[2], 0, 2) : '**';
                                    @endphp
                                    **/{{ $month }}/{{ $year }} <a href="#" onclick="editBirthdate()">Thay đổi</a>
                                </p>
                                <input type="date" id="birthdate-input" name="birthdate" class="form-control d-none"
                                    value="{{ old('birthdate', $user->birthdate) }}">
                            </div>
                            <button type="submit" class="btn btn-warning">Lưu</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Divider -->
            <div class="vertical-divider"></div>

            <!-- Avatar Section -->
            <div class="avatar text-center">
                <form action="{{ route('account.updateAvatar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <img src="{{ asset($user->profile_image) }}" alt="Avatar" width="100" class="mb-2">
                    <div class="mt-2">
                        <label class="custom-file-upload">
                            Chọn Ảnh
                            <input type="file" name="avatar" style="display: none;" onchange="this.form.submit()">
                        </label>
                    </div>
                    <p>Dung lượng tối đa 1 MB<br>Định dạng: JPEG, PNG</p>
                </form>
            </div>
        </div>
    </div>

    <!-- Activity Log -->
    <div class="activity-log">
        <h4>Nhật ký hoạt động</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nội dung</th>
                    <th>Thời gian hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activityLogs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->action }}</td>
                    <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination justify-content-center">
            {{ $activityLogs->links('pagination::bootstrap-4') }}
            <!-- Laravel sử dụng template của Bootstrap -->
        </div>
    </div>
</div>

<script>
function editPhone() {
    document.getElementById("phone-display").classList.add("d-none");
    document.getElementById("phone-input").classList.remove("d-none");
}

function editBirthdate() {
    document.getElementById("birthdate-display").classList.add("d-none");
    document.getElementById("birthdate-input").classList.remove("d-none");
}
</script>

@endsection