@extends('header_footer')

@section('main')
<div class="container">
    <h1>Tìm kiếm sản phẩm</h1>

    <!-- Form tìm kiếm -->
    <form action="{{ route('search') }}" method="GET">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="brand">Tìm theo tên sản phẩm</label>
                    <input type="text" name="query" id="query" value="{{ old('query', $query ?? '') }}"
                        class="form-control" placeholder="Bạn muốn tìm gì?">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="brand">Tìm theo thương hiệu</label>
                    <select class="form-control" id="BrandId" name="BrandId">
                        <option value="">Chọn thương hiệu</option>
                        @foreach($brands as $brand)
                        <option value="{{ $brand->BrandId }}">{{ $brand->BrandName }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <!-- Kết quả tìm kiếm -->
    <div class="mt-4">
        @if($products->isEmpty())
        <div class="alert alert-warning" role="alert">
            Không tìm thấy sản phẩm.
        </div>
        @else
        <!-- Phần sản phẩm -->
        <section class="products">
            <div class="container">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 section-products" id="product-list">
                    @foreach($products as $product)
                    <div class="col">
                        <div class="product-card">
                            <img class="image-products" src="{{ $product->image_url }}" alt="hình ảnh">
                            <div class="product-title">{{ $product->name }}</div>
                            <div class="product-price">{{ number_format($product->price, 0, ',', '.') }} VND</div>
                            <div class="icon-btn">
                                <div class="icon-products">
                                    <i class="{{ $product->is_favorited ? 'fas fa-heart' : 'far fa-heart' }} favorite-btn"
                                        data-product-id="{{ $product->ProductId }}"></i>
                                </div>
                                <button class="btn-add-to-cart">Thêm vào giỏ hàng</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
        </section>

         <!-- Hiển thị phân trang -->
         <div class="mt-4">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
        @endif
    </div>
</div>
@endsection