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