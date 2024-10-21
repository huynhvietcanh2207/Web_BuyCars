<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function Laravel\Prompts\alert;

class CartItemController extends Controller
{

    public function index()
    {
        // Lấy tất cả các mục giỏ hàng và phân trang
        $cartItems = CartItem::with('product')->orderBy('updated_at', 'desc')->paginate(5);

        return view('cart', ['cartItems' => $cartItems]);
    }

    // public function destroy($id)
    // {
    //     $cartItem = DB::table('cart_items')->where('CartItemId', $id)->delete();
    //     return view('cart', ['cartItems' => $cartItem]);
    // }
    public function destroy($id)
    {
        DB::table('cart_items')->where('CartItemId', $id)->delete();
        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa thành công.');
    }

    public function updateCart(Request $request)
    {
        $cartItems = $request->input('cartItems');

        foreach ($cartItems as $id => $item) {
            $cartItem = CartItem::findOrFail($id);
            $cartItem->quantity = $item['quantity'];
            $cartItem->price = $item['price'];
            $cartItem->save();
        }

        return redirect()->route('cart.index')->with('message', 'Giỏ hàng đã được cập nhật thành công.');
    }
}
