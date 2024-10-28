@extends('header_footer')

@section('title', 'Tất Cả Thương Hiệu')

@section('main')

<section class="products">
    <h1>Thương Hiệu</h1>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 section-products">
            @if ($brands->isEmpty())
                <p>Chưa có thương hiệu nào!</p>
            @else
                @foreach ($brands as $brand)
                    <div class="col-4">
                        <div class="product-card">
                            <img class="image-products" src="{{ $brand->BrandImage }}" alt="{{ $brand->BrandName }}">
                            <div class="product-title">
                                <a href="{{ route('brands.show', $brand->BrandId) }}">{{ $brand->BrandName }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

@endsection