<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Auth;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if (Auth::check()) {
        //     $id = Auth::user()->id;
        // } else {
        //     return redirect("login"); // Đảm bảo trả về redirect
        // }

        $favorites = Favorite::where('user_id',1)->paginate(5);
        return view("favorite",compact("favorites"));
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
    public function show(Favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favorite $favorite)
    {
        //
    }

    public function addToFavorites(Request $request, $productId)
    {
        $userId = Auth::id(); // Lấy ID người dùng đã đăng nhập
        $userId = 1; // Lấy ID người dùng đã đăng nhập

        // Kiểm tra xem sản phẩm đã tồn tại trong danh sách yêu thích chưa
        if (!Favorite::where('user_id', $userId)->where('ProductId', $productId)->exists()) {
            // Tạo một bản ghi mới trong bảng favorites
            Favorite::create([
                'user_id' => $userId,
                'ProductId' => $productId,
            ]);
        }

        return back()->with('success', 'Sản phẩm đã được thêm vào danh sách yêu thích!');
    }

    public function remove(Request $request, $productId)
    {
        $userId = Auth::id(); // Lấy ID người dùng đã đăng nhập
        $userId = 1; // Lấy ID người dùng đã đăng nhập

    // Tìm bản ghi yêu thích và xóa nó
        Favorite::where('user_id', $userId)
                ->where('ProductId', $productId)
                ->delete();

        return response()->json(['success' => 'Sản phẩm đã được xóa khỏi danh sách yêu thích!']);
    }
}
