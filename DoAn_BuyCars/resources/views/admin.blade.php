<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>BuyCars - Admin</title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    integrity="sha512-yK+RPn9vBM6kU+pHxMZTZdAdW1U1Rm6xaT+vLgBNGVOCmnMEI7b6t7Sk67S9aox+N7ZOCqtnZ0R+bv1vyD7zw=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


  <!-- Core CSS Files -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/kaiadmin.min.css') }}">

</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" data-background-color="dark">
      <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
          <a href="index.html" class="logo">
            <img src="{{ asset('56.jpg')}}" alt="navbar brand" class="navbar-brand" height="20" />
          </a>
          <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
            <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
          </div>
          <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
        </div>
      </div>
      <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
          <ul class="nav nav-secondary">
            <li class="nav-item active">
              <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                <i class="fas fa-home"></i>
                <p>Trang Chủ</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="dashboard">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="#">
                      <span class="sub-item">Dashboard 1</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-section">
              <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
              <h4 class="text-section">Components</h4>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#submenu">
                <i class="fas fa-bars"></i>
                <p>Danh Mục Quản Lý</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="submenu">
                <ul class="nav nav-collapse">
                  <li><a href="#"><span class="sub-item">Quản lý Người dùng</span></a></li>
                  <li><a href="{{ route('products.index') }}"><span class="sub-item">Quản lý Sản phẩm</span></a></li>
                  <li><a href="{{ route('brands.index') }}"><span class="sub-item">Quản lý Thương hiệu</span></a></li>
                  <li><a href="#"><span class="sub-item">Quản lý Đơn Hàng</span></a></li>
                  <li><a href="#"><span class="sub-item">Quản lý Bình luận</span></a></li>
                  <li><a href="{{ route('vouchers.index') }}"><span class="sub-item">Quản lý Voucher</span></a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.chart.index')}}">
                <i class="fas fa-bars"></i>
                <p>Danh thu và báo cáo</p>
              </a>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#">
                <i class="fas fa-bars"></i>
                <p>Phân quyền</p>
              </a>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#">
                <i class="fas fa-bars"></i>
                <p>Xuất</p>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- End Sidebar -->

    <div class="main-panel">
      <div class="main-header">
        <div class="main-header-logo">
          <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
              <img src="assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
              <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
            </div>
            <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="page-inner">
          <div class="page-header">
            @yield('main')

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Core JS Files -->
  <script src="{{ asset('js/bootstrap.min.js') }}"></script> <!-- Đổi href thành src -->

</body>

</html>