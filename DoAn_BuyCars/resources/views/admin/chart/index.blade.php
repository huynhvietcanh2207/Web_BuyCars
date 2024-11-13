@extends('admin')
@section('main')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>

    <body>
        <div class="container">
            <div class="page-inner">
                <!-- SỐ HÓA THỐNG KÊ -->
                <h3 class="fw-bold mb-3">SỐ HÓA THỐNG KÊ</h3>
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-primary card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Người dùng</p>
                                            <h4 class="card-title">{{ $userCount }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-info card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="fas fa-car"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Thương hiệu</p>
                                            <h4 class="card-title">{{ $brandCount }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-success card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="fas fa-chart-pie"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Yêu Thích</p>
                                            <h4 class="card-title">{{ $favoriteCount }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-secondary card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="fas fa-luggage-cart"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Bình luận</p>
                                            <h4 class="card-title">{{ $commentCount }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Chart --}}
            <div class="page-inner">
                <h3 class="fw-bold mb-3">BIỂU ĐỒ THỐNG KÊ</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Biểu Đồ Thu Chi</div>
                            </div>
                            <div class="card-body">
                                <div id="chart-data" data-income="{{ $income }}" data-expenses="{{ $expenses }}">
                                </div>
                                <div class="chart-container">
                                    <canvas id="pieChart" style="width: 50%; height: 50%"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div id="user-chart-data" data-user="{{ json_encode($userStatistics['months']) }}"
                                    data-counts="{{ json_encode($userStatistics['counts']) }}"></div>
                                <div class="card-title">Biểu Đồ Người Dùng</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="barChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Biểu Đồ Thương Hiệu</div>
                            </div>
                            <div class="card-body">
                                <div id="brand-chart-data" data-labels="{{ json_encode($brandStatistics['labels']) }}"
                                    data-brand="{{ json_encode($brandStatistics['data']) }}">
                                </div>
                                <div class="chart-container">
                                    <canvas id="multipleBarChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Our Location</div>
                            </div>
                            <div class="card-body">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d62619.59394663438!2d106.60555339185996!3d10.762622083783974!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752929225b715b%3A0x14e7cf33f2a8f2e2!2sHo%20Chi%20Minh%20City!5e0!3m2!1sen!2s!4v1701057782339!5m2!1sen!2s"
                                    width="100%" height="600" style="border: 0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="{{ asset('js/plugin/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('js/plugin/chart.js/chart.js') }}"></script>

    </html>
@endsection
