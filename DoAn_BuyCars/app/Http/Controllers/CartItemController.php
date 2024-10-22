<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function addToCart(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,ProductId',
            'user_id' => 'required|exists:users,id',
        ]);

        // Lấy ID Sản phẩm và ID người dùng
        $productId = $validatedData['product_id'];
        $userId = $validatedData['user_id'];

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng của người dùng chưa
        $cartItem = CartItem::where('UserId', $userId)
            ->where('ProductId', $productId)
            ->first();

        if ($cartItem) {
            // Nếu đã tồn tại, tăng số lượng lên 1
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // Nếu chưa có, tạo mới mục giỏ hàng
            $product = Product::find($productId); // Lấy thông tin sản phẩm
            CartItem::create([
                'UserId' => $userId, // Đảm bảo UserId được truyền vào đây
                'ProductId' => $productId,
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }


}
