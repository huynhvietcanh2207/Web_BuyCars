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
            return redirect()->route('home')->with('error', 'ID sản phẩm không hợp lệ!');
        }

        // Lấy thông tin sản phẩm và bình luận từ database
        $product = Product::find($decodedId);
        $comments = Comment::where('ProductId', $decodedId)->orderBy('CreatedAt', 'desc')->get();

        if (!$product) {
            return redirect()->route('home')->with('error', 'Sản phẩm không tồn tại!');
        }

        return view('detail', compact('product', 'comments'));
    }

    public function addComment(Request $request, $encodedId)
    {
        // Giải mã ID từ URL
        $decodedId = IdEncoder::decodeId($encodedId);

        if ($decodedId === null) {
            // Nếu ID không hợp lệ
            return redirect()->back()->with('error', 'ID sản phẩm không hợp lệ!');
        }

        // Kiểm tra người dùng đã đăng nhập chưa
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'Vui lòng đăng nhập để bình luận.');
        }

        // Validate dữ liệu đầu vào
        $request->validate([
            'CommentText' => 'required|string|max:500',
        ]);

        // Thêm bình luận vào cơ sở dữ liệu
        Comment::create([
            'ProductId' => $decodedId, // Lưu ProductId đã giải mã
            'id' => auth()->user()->id, // Lấy ID người dùng từ phiên đăng nhập
            'CommentText' => $request->CommentText,
            'CreatedAt' => now(),
        ]);

        return redirect()->back()->with('success', 'Bình luận của bạn đã được thêm!');
    }
}
