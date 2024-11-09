@extends('header_footer')

@section('main')
    <h1>Search Results</h1>

    <!-- Search form -->
    <form action="{{ route('search') }}" method="GET" class="search-form">
        <input type="text" name="query" value="{{ request('query') }}" placeholder="Search by name or description">
        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min Price">
        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max Price">
        <button type="submit">Search</button>
    </form>

    <!-- Display search results -->
    @if($products->isEmpty())
        <p>No products found for your search criteria.</p>
    @else
        <div class="products-list">
            @foreach($products as $product)
                <div class="product-card">
                    <a href="{{ route('detail.index', ['id' => $product->ProductId]) }}">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                    </a>
                    <div class="product-info">
                        <h2>{{ $product->name }}</h2>
                        <p>{{ $product->description }}</p>
                        <p>{{ number_format($product->price, 0, ',', '.') }} VND</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
