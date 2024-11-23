<?php

namespace App\Http\Controllers;

use App\Helpers\IdEncoder;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Comment;

class DetailController extends Controller
{
    // public function indexDetail($id)
    // {
    //     $product = Product::with('brand')->where("ProductId", $id)->firstOrFail();
    //     return view("detail", compact("product"));
    // }

    public function indexDetail($encodedId)
    {
        // Giải mã ID từ URL
        $decodedId = IdEncoder::decodeId($encodedId);

        if ($decodedId === null) {
            // Nếu ID không hợp lệ
            return redirect()->route('home')->with('error', 'ID không hợp lệ!');
        }
        $comments = Comment::getCommentsByProductId($encodedId);

        // Lấy thông tin sản phẩm từ database bằng ID đã giải mã
        $product = Product::find($decodedId);

        if (!$product) {
            return redirect()->route('home')->with('error', 'Sản phẩm không tồn tại!');
        }

        return view('detail', compact('product','comments'));
    }
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
