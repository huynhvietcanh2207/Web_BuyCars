<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    // public function search(Request $request)
    // {
    //     // Lấy dữ liệu từ request
    //     $query = $request->input('query'); // Từ khóa tìm kiếm
    //     $brandId = $request->input('brand'); // ID thương hiệu

    //     // Khởi tạo query
    //     $products = Product::query();

    //     // Tìm kiếm Full-Text
    //     if ($query) {
    //         $products->whereRaw("MATCH(name, description) AGAINST(? IN NATURAL LANGUAGE MODE)", [$query]);
    //     }

    //     // Lọc theo thương hiệu nếu có
    //     if ($brandId) {
    //         $products->where('brand_id', $brandId);
    //     }

    //     // Phân trang kết quả
    //     $products = $products->paginate(6);

    //     // Lấy danh sách thương hiệu cho dropdown
    //     $brands = Brand::all();

    //     // Trả về view với dữ liệu
    //     return view('indexSearch', compact('products', 'brands', 'query', 'brandId'));
    // }
    public function search(Request $request)
    {
        $query = $request->input('query'); // Từ khóa tìm kiếm
        $brandId = $request->input('brand'); // ID thương hiệu

        // Khởi tạo query
        $products = Product::query();

        // Tìm kiếm bằng LIKE
        if ($query) {
            $products->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', '%' . $query . '%')
                    ->orWhere('description', 'LIKE', '%' . $query . '%');
            });
        }

        // Lọc theo thương hiệu nếu có
        if ($brandId) {
            $products->where('brand_id', $brandId);
        }

        // Phân trang kết quả
        $products = $products->paginate(6);

        // Lấy danh sách thương hiệu cho dropdown
        $brands = Brand::all();

        // Trả về view với dữ liệu
        return view('indexSearch', compact('products', 'brands', 'query', 'brandId'));
    }

    public function showProducts()
    {
        // Lấy danh sách sản phẩm với phân trang
        $products = Product::orderBy('created_at', 'desc')->paginate(8);

        if (Auth::check()) {
            $userId = Auth::id();
            $favoriteProductIds = Favorite::where('user_id', $userId)->pluck('ProductId')->toArray();

            foreach ($products as $product) {
                $product->is_favorited = in_array($product->ProductId, $favoriteProductIds);
            }
        }
        $brands = Brand::all();
        $colors = Product::select('color')->distinct()->pluck('color');
        // Truyền danh sách sản phẩm sang view 'product'
        return view('product', compact('products', 'brands', 'colors'));
    }
    public function filter(Request $request)
    {
        // Lấy dữ liệu từ request
        $brandIds = $request->input('brand', []); // Mảng các BrandId đã chọn
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $color = $request->input('color');
        // Xây dựng query
        $query = Product::query();

        // Lọc theo thương hiệu
        if (!empty($brandIds)) {
            $query->whereIn('BrandId', $brandIds);
        }

        // Lọc theo giá
        if ($minPrice) {
            $query->where('price', '>=', $minPrice);
        }
        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        }

        // Lọc theo màu sắc
        if ($color) {
            $query->where('color', $color);
        }

        // Lấy danh sách sản phẩm đã lọc
        $products = $query->get();
        $userId = Auth::id();
        $favoriteProductIds = Favorite::where('user_id', $userId)->pluck('ProductId')->toArray();

        foreach ($products as $product) {
            $product->is_favorited = in_array($product->ProductId, $favoriteProductIds);
        }

        // Nếu là yêu cầu AJAX, trả về partial view
        if ($request->ajax()) {
            $view = view('partials.products_list', compact('products'))->render();
            return response()->json(['html' => $view]);
        }
    }
}
