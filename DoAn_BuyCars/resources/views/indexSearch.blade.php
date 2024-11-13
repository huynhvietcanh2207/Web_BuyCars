@extends('header_footer')

@section('main')
<div class="container">
    <h1>Tìm kiếm sản phẩm</h1>

    <!-- Search Form -->
    <!-- <form action="{{ route('search') }}" method="GET" class="search-form">
        <div class="form-group">
            <input type="text" name="query" value="{{ request('query') }}" placeholder="Search by name or description" class="form-control">
        </div>

        <div class="form-group">
            <select name="brand" class="form-control">
                <option value="">Select Brand</option>
                @foreach($brands as $brand)
                <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min Price (500,000,000)" class="form-control" min="500000000" max="50000000000">
        </div>
        <div class="form-group">
            <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max Price (50,000,000,000)" class="form-control" min="500000000" max="50000000000">
        </div>

        <button type="submit" class="btn btn-primary mt-2">Search</button>
    </form> -->
    <form action="{{ route('search') }}" method="GET" class="search-form">
        <div class="form-group">
            <input type="text" name="query" value="{{ request('query') }}" placeholder="Search by name or description" class="form-control">
        </div>

        <div class="form-group">
             <select class="form-control" id="BrandId" name="BrandId" required>
                <option value="">Chọn thương hiệu</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->BrandId }}">{{ $brand->BrandName }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Search</button>
    </form>



 
    <div class="mt-4">
        @if($products->isEmpty())
        <p>Không tìm thấy dữ liệu</p>
        @else
        <div class="row">
            @foreach($products as $product)
            <div class="col-md-3">
                <div class="card mb-4">
                    <a href="{{ route('detail.index', ['id' => $product->ProductId]) }}">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="card-img-top">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">{{ number_format($product->price, 0, ',', '.') }} VND</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection