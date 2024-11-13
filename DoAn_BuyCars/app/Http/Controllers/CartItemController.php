<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class CartItemController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
        } else {
            return redirect("login");
        }
        $cartItems = CartItem::with('product')
        ->where('UserId', $id) // Lọc theo UserId của người dùng đang đăng nhập
            ->orderBy('updated_at', 'desc')
            ->paginate(5);

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

    //Xóa sản phẩm chọn
    public function chooseDelete(Request $request)
    {
        $cartItemIds = $request->input('cartItemIds', []);

        if (count($cartItemIds) > 0
        ) {
            CartItem::whereIn('CartItemId', $cartItemIds)->delete();
        }

        return response()->json(['message' => 'Các mục đã được xóa thành công.']);
    }

    public function updateCart(Request $request)
    {
        $cartItemId = $request->cartItemId;
        $quantity = $request->quantity;

        $cartItem = CartItem::find($cartItemId);
        if ($cartItem) {
            $cartItem->quantity = $quantity;
            $cartItem->price = $cartItem->product->price * $cartItem->quantity;
            $cartItem->save();

            $updatedItemPrice = number_format($cartItem->price, 0, ',', '.') . '₫';
            // Return JSON response instead of dumping
            return response()->json(['updatedItemPrice' => $updatedItemPrice]);
        }

        return response()->json(['error' => 'Không tìm thấy sản phẩm.'], 404);
    }

    public function addToCart(Request $request)
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
        } else {
            return redirect("login"); // Đảm bảo trả về redirect
        }
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,ProductId',
            'user_id' => 'required|exists:users,id',
        ]);

        $productId = $validatedData['product_id'];
        $userId = $validatedData['user_id'];

        $cartItem = CartItem::where('UserId', $userId)
            ->where('ProductId', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $product = Product::find($productId);
            $cartItem->price = $product->price * $cartItem->quantity;
            $cartItem->save();
        } else {
            $product = Product::find($productId);
            CartItem::create([
                'UserId' => $userId,
                'ProductId' => $productId,
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }
        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }

    public function showCart($userId)
    {
        $cartItems = CartItem::where('UserId', $userId)->get();

        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->quantity * $item->price;
        }
        return view('cart', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
        ]);
    }
    
}
