<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Comment;
use App\Models\UserRoleAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    public function indexDetail($id)
    {
        $user = auth()->user();
        $isBannedFromCommenting = false;

        if ($user) {
            // Kiểm tra nếu người dùng có RoleId = 2
            $assignment = UserRoleAssignment::where('user_id', $user->id)->where('RoleId', 2)->first();
            $isBannedFromCommenting = $assignment ? true : false;
        }

        $product = Product::where("ProductId", $id)->firstOrFail();
        $comments = $product->comments()->orderBy('CreatedAt', 'desc')->get();
        return view('detail', compact('product', 'isBannedFromCommenting', 'comments'));
    }
    // public function indexDetail($id)
    // {
    //     $product = Product::where("ProductId", $id)->firstOrFail();
    //     $comments = $product->comments()->orderBy('CreatedAt', 'desc')->get();
    //     return view('detail', compact('product', 'comments'));
    // }

    public function addComment(Request $request, $id)
    {
        $request->validate([
            'CommentText' => 'required|string|max:500',
        ], [
            'CommentText.required' => 'Vui lòng nhập nội dung bình luận.',
            'CommentText.string' => 'Bình luận không hợp lệ.',
            'CommentText.max' => 'Bình luận không được vượt quá 500 ký tự.',
        ]);

        $user = auth()->user();

        Comment::create([
            'ProductId' => $id,
            'id' => $user->id,
            'CommentText' => $request->input('CommentText'),
            'CreatedAt' => now(),
        ]);

        return redirect()->back()->with('success', 'Bình luận của bạn đã được đăng.');
    }


}