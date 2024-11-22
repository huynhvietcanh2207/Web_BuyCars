<?php

namespace App\Http\Controllers;

use App\Helpers\IdEncoder;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Http\Request;

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

        // Lấy thông tin sản phẩm từ database bằng ID đã giải mã
        $product = Product::find($decodedId);

        if (!$product) {
            return redirect()->route('home')->with('error', 'Sản phẩm không tồn tại!');
        }

        return view('detail', compact('product'));
    }

}
