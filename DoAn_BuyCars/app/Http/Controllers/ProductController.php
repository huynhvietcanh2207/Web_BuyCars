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
    //tim theo giá, tên sp, giá trong khoảng 500m -> 50b
    // public function search(Request $request)
    // {
    //     // Retrieve search inputs
    //     $query = $request->input('query');
    //     $brandId = $request->input('brand'); // Brand ID from the dropdown
    //     $minPrice = $request->input('min_price', 0);
    //     $maxPrice = $request->input('max_price', 50000000000);
    
    //     // Ensure min and max prices are within allowed range
    //     $minPrice = max(500000000, min($minPrice, 0));
    //     $maxPrice = max(500000000, min($maxPrice, 50000000000));
    
    //     // Build the product search query
    //     $products = Product::query();
    
    //     // Filter by name or description if a search query is provided
    //     if ($query) {
    //         $products->where(function($q) use ($query) {
    //             $q->where('name', 'LIKE', '%' . $query . '%')
    //               ->orWhere('description', 'LIKE', '%' . $query . '%');
    //         });
    //     }
    
    //     // Filter by brand if a brand is selected
    //     if ($brandId) {
    //         $products->where('brand_id', $brandId);
    //     }
    
    //     // Apply the price range filter
    //     $products->whereBetween('price', [$minPrice, $maxPrice]);
    
    //     // Get the filtered results
    //     $products = $products->get();
    
    //     // Fetch all brands for the dropdown in the view
    //     $brands = Brand::all();
    
    //     // Pass the results and brands to the view
    //     return view('indexSearch', compact('products', 'brands', 'query', 'minPrice', 'maxPrice', 'brandId'));
    // }

    //update them phan trang SearchIndex
    public function search(Request $request)
{
    // Retrieve search inputs
    $query = $request->input('query');
    $brandId = $request->input('brand'); // Brand ID from the dropdown

    // Build the product search query
    $products = Product::query();

    // Filter by name or description if a search query is provided
    if ($query) {
        $products->where(function($q) use ($query) {
            $q->where('name', 'LIKE', '%' . $query . '%')
              ->orWhere('description', 'LIKE', '%' . $query . '%');
        });
    }

    // Filter by brand if a brand is selected
    if ($brandId) {
        $products->where('brand_id', $brandId);
    }

    // Get the filtered results
    $products = $products->get();

    // Fetch all brands for the dropdown in the view
    $brands = Brand::all();

    // Pass the results and brands to the view
    return view('indexSearch', compact('products', 'brands', 'query', 'brandId'));
}

    

    //Tìm theo giá, tên sp
    // public function search(Request $request)
    // {
    //     // Retrieve search inputs
    //     $query = $request->input('query');
    //     $minPrice = $request->input('min_price');
    //     $maxPrice = $request->input('max_price');
    
    //     // Build the product search query
    //     $products = Product::query();
    
    //     // Filter by name or description if a search query is provided
    //     if ($query) {
    //         $products->where(function($q) use ($query) {
    //             $q->where('name', 'LIKE', '%' . $query . '%')
    //               ->orWhere('description', 'LIKE', '%' . $query . '%');
    //         });
    //     }
    
    //     // Filter by price range if provided
    //     if ($minPrice) {
    //         $products->where('price', '>=', $minPrice);
    //     }
    //     if ($maxPrice) {
    //         $products->where('price', '<=', $maxPrice);
    //     }
    
    //     // Get the filtered results
    //     $products = $products->get();
    
    //     // Pass the results to the view along with search parameters
    //     return view('indexSearch', compact('products', 'query', 'minPrice', 'maxPrice'));
    // }
    
    

    
    

    
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
