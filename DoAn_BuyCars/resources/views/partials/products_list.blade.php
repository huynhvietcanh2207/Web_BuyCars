<!-- resources/views/partials/products.blade.php -->
@foreach ($products as $product)
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