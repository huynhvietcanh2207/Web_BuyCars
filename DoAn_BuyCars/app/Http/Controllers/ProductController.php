<?php

namespace App\Http\Controllers;
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

        // Truyền danh sách sản phẩm sang view 'product'
        return view('product', compact('products'));
    }

}
