<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

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
    public function show(Product $product)
    {
        // Lấy tất cả các bình luận của sản phẩm
        $comments = $product->comments()->latest()->get();

        return view('detail', compact('product', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function comment(Request $request, $productId)
    {
        // Xác thực dữ liệu
        $request->validate([
            'username' => 'required|string|max:255',
            'comment' => 'required|string',
        ]);

        // Tạo bình luận mới
        Comment::create([
            'product_id' => $productId,
            'username' => $request->input('username'),
            'content' => $request->input('comment'),
        ]);

        // Chuyển hướng lại trang sản phẩm với thông báo thành công
        return redirect()->route('product.show', $productId)->with('success', 'Bình luận của bạn đã được gửi.');
    }
}