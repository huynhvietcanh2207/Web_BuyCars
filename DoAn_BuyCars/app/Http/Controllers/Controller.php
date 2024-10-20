<?php

namespace App\Http\Controllers;

use App\Models\Product; // Import model Product
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        // Lấy 5 sản phẩm mới nhất để hiển thị trong carousel
        $newProducts = Product::orderBy('created_at', 'desc')->take(5)->get();

        // Lấy danh sách sản phẩm với phân trang và sắp xếp theo thứ tự giảm dần của ngày tạo
        $products = Product::orderBy('created_at', 'desc')->paginate(8);

        // Truyền danh sách sản phẩm và sản phẩm mới sang view
        return view('index', compact('products', 'newProducts'));
    }
}
