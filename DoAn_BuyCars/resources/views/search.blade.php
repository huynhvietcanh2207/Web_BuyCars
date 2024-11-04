<div class="s010">
    <form action="{{ route('products.search') }}" method="GET">
        <div class="inner-form">
            <div class="basic-search">
                <div class="input-field">
                    <input id="search" type="text" name="name" placeholder="What are you looking for (?)" value="{{ request('name') }}" />
                    <div class="icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="advance-search">
                <span class="desc">Danh sách nội dung tìm kiếm </span>
                <div class="row">
                    <div class="input-field">
                        <div class="input-select">
                            <select name="BrandId">
                                <option value="">Tìm theo thương hiệu</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ request('BrandId') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="input-field">
                        <div class="input-select">
                            <select name="price_order">
                                <option value="">Tìm theo giá</option>
                                <option value="asc" {{ request('price_order') == 'asc' ? 'selected' : '' }}>Giá tăng dần</option>
                                <option value="desc" {{ request('price_order') == 'desc' ? 'selected' : '' }}>Giá giảm dần</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-field">
                        <div class="input-select">
                            <select name="color">
                                <option value="">Tìm theo màu</option>
                                <option value="red" {{ request('color') == 'red' ? 'selected' : '' }}>Đỏ</option>
                                <option value="blue" {{ request('color') == 'blue' ? 'selected' : '' }}>Xanh</option>
                                <option value="black" {{ request('color') == 'black' ? 'selected' : '' }}>Đen</option>
                                <!-- Add more colors as needed -->
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row second">
                    <div class="result-count">
                        <div class="group-btn">
                            <button class="btn-delete" id="delete">RESET</button>
                            <button type="submit" class="btn-search">SEARCH</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="search-results">
    <h3>Search Results:</h3>
    @if($products->isEmpty())
        <p>No products found matching your criteria.</p>
    @else
        @foreach($products as $product)
            <div class="product-item">
                <h4>{{ $product->name }}</h4>
                <p>Brand: {{ $product->brand->name ?? 'N/A' }}</p>
                <p>Price: ${{ $product->price }}</p>
                <p>Color: {{ ucfirst($product->color) }}</p>
                <p>Description: {{ $product->description }}</p>
                <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" width="100">
            </div>
        @endforeach
    @endif
</div>

