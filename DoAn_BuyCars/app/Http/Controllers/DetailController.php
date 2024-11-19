<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function indexDetail($id)
    {
        $comments = Comment::getCommentsByProductId($id);
        $product = Product::where("ProductId", $id)->firstOrFail();
        return view("detail", compact("product", "comments"));
    }

    // public function indexDetail($id)
    // {
    //     $product = Product::where("ProductId", $id)->firstOrFail();
    //     return view("detail", compact("product"));
    // }

    public function addComment(Request $request, $id)
    {
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'Vui lòng đăng nhập để bình luận.');
        }

        $request->validate([
            'CommentText' => 'required|string|max:500',
        ]);

        Comment::create([
            'ProductId' => $id,
            'id' => auth()->user()->id, // Đảm bảo user đã đăng nhập
            'CommentText' => $request->CommentText,
            'CreatedAt' => now(),
        ]);

        return redirect()->back()->with('success', 'Bình luận của bạn đã được thêm!');
    }


}