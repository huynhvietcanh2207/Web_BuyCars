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
        if (!Auth::check()) {
            return redirect('login');
        }

        $userId = Auth::id();
        $cartItems = CartItem::getUserCartItems($userId)->paginate(5);

        return view('cart', ['cartItems' => $cartItems]);
    }

    public function destroy($id)
    {
        CartItem::deleteProductID($id);
        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa thành công.');
    }

    public function chooseDelete(Request $request)
    {
        $cartItemIds = $request->input('cartItemIds', []);

        if (!empty($cartItemIds)) {
            CartItem::deleteProductListID($cartItemIds);
        }

        return response()->json(['message' => 'Các mục đã được xóa thành công.']);
    }

    public function updateCart(Request $request)
    {
        $cartItemId = $request->cartItemId;
        $quantity = $request->quantity;

        $cartItem = CartItem::updateCartItem($cartItemId, $quantity);

        if ($cartItem) {
            $updatedItemPrice = number_format($cartItem->price, 0, ',', '.') . '₫';
            return response()->json(['updatedItemPrice' => $updatedItemPrice]);
        }

        return response()->json(['error' => 'Không tìm thấy sản phẩm.'], 404);
    }

    public function addToCart(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,ProductId',
        ]);

        $productId = $validatedData['product_id'];
        $userId = Auth::id();
        $quantity = $request->input('quantity', 1);

        CartItem::addOrUpdateCartItem($userId, $productId, $quantity);

        return redirect()->route('index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }

    // public function showCart($userId)
    // {
    //     $cartItems = CartItem::getUserCartItems($userId)->get();
    //     $totalPrice = CartItem::calculateTotalPrice($userId);

    //     return view('cart', [
    //         'cartItems' => $cartItems,
    //         'totalPrice' => $totalPrice,
    //     ]);
    // }
    
}
