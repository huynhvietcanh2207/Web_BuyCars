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
                    @foreach ($products as $product)
                        <div class="col">
                            <div class="product-card">
                                <div class="item-img">
                                    <a href="{{ route('detail.index', ['id' => $product->ProductId]) }}">
                                        <img class="image-products" src="{{ asset($product->image_url) }}" alt="{{$product->name}}">
                                    </a>
                                </div>
                                <div class="product-title">{{ $product->name }}</div>
                                <div class="product-price">{{ number_format($product->price, 0, ',', '.') }} VND</div>
                                <div class="icon-btn">
                                    <div class="icon-products">
                                        <i class="{{ $product->is_favorited ? 'fas fa-heart' : 'far fa-heart' }} favorite-btn"
                                            data-product-id="{{ $product->ProductId }}"></i>
                                    </div>
                                    {{-- <button class="btn-add-to-cart">Thêm vào giỏ hàng</button> --}}
                                    <form action="{{ route('cart.add', $product->ProductId) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->ProductId }}">
                                        @if (auth()->check())
                                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                        @endif
                                        <button class="btn-add-to-cart" type="submit">Thêm vào giỏ hàng</button>
                                    </form>
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