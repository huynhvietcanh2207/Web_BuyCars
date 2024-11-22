<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CrudCommentController extends Controller
{
    /**
     * Hiển thị danh sách bình luận.
     */
    public function index()
    {
        // Lấy giá trị lọc từ query string, mặc định là 'asc'
        $sort_by = request('sort_by', 'asc');

        // Lấy danh sách bình luận và sắp xếp theo ID
        $comments = Comment::orderBy('CommentId', $sort_by)->paginate(4);

        // Truyền dữ liệu ra view
        return view('admin.comments.index', compact('comments', 'sort_by'));
    }


    /**
     * Hiển thị form tạo bình luận mới.
     */
    public function create()
    {
        return view('admin.comments.create'); // Bạn có thể tạo view tương ứng cho form tạo bình luận
    }

    /**
     * Lưu bình luận mới vào cơ sở dữ liệu.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'ProductId' => 'required|integer',
            'UserId' => 'required|integer',  // ID người dùng (thay 'id' bằng 'UserId' cho rõ ràng hơn)
            'CommentText' => 'required|string',
        ]);

        // Tạo bình luận mới
        Comment::create([
            'ProductId' => $request->ProductId,
            'UserId' => $request->UserId,
            'CommentText' => $request->CommentText,
            'CreatedAt' => now(),
        ]);

        return redirect()->route('comments.index')->with('success', 'Bình luận đã được thêm thành công!');
    }

    /**
     * Hiển thị chi tiết một bình luận cụ thể.
     */
    public function show(string $id)
    {
        // Lấy bình luận cụ thể theo ID
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        return view('admin.comments.show', compact('comment')); // Nếu bạn muốn hiển thị chi tiết trong view
    }

    /**
     * Hiển thị form chỉnh sửa bình luận.
     */
    public function edit(string $id)
    {
        $comment = Comment::findOrFail($id);
        return view('admin.comments.edit', compact('comment')); // Tạo view tương ứng cho form chỉnh sửa
    }

    /**
     * Cập nhật bình luận trong cơ sở dữ liệu.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'CommentText' => 'required|string',
        ]);

        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        $comment->update([
            'CommentText' => $request->CommentText,
        ]);

        return redirect()->route('comments.index')->with('success', 'Bình luận đã được cập nhật thành công!');
    }

    /**
     * Xóa bình luận khỏi cơ sở dữ liệu.
     */
    public function destroy(string $id)
    {
        // Xóa bình luận
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        $comment->delete();
        return redirect()->route('comments.index')->with('success', 'Bình luận đã được xóa thành công!');
    }
}
