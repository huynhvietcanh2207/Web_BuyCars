@extends('header_footer')

@section('title', $title)

@section('main')



<section class="products">
    <h1>{{ $brand->BrandName }}</h1>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 section-products">
            @if($products->isEmpty())
                <p>Không có sản phẩm nào thuộc thương hiệu này.</p>
            @else
                    @foreach($products as $product)
                        <div class="col-md-3">
                            <div class="product-card">
                                <img class="image-products" src="{{ $product->ImageUrl }}" alt="{{ $product->Name }}">
                                <div class="product-title">{{ $product->Name }}</div>
                                <div class="product-price">Giá: {{ number_format($product->Price, 2) }} VNĐ</div>
                                <div class="icon-btn">
                                    <div class="icon-products">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                    <button class="btn-add-to-cart">Thêm vào giỏ hàng</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
    </div>
    <!-- phân trang -->
    <div class="pagination justify-content-center">
        {{ $products->links('pagination::bootstrap-4') }}
        <!-- Laravel sử dụng template của Bootstrap -->
    </div>

</section>

@endsection