<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
    public function index()
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect("login");
        }

        // Retrieve cart items from the session
        $cartItems = session()->get('cart.items', []);

        // Calculate total price
        $totalPrice = array_sum(array_map(function ($item) {
            return $item['quantity'] * $item['price'];
        }, $cartItems));

        return view('cart', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
        ]);
    }

    public function addToCart(Request $request)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect("login");
        }

        // Validate the incoming request data
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,ProductId',
        ]);

        $productId = $validatedData['product_id'];

        // Retrieve the cart from the session
        $cart = session()->get('cart.items', []);

        // Check if the product already exists in the user's cart
        if (isset($cart[$productId])) {
            // Increment quantity if the item already exists
            $cart[$productId]['quantity'] += 1;
        } else {
            // Create a new cart item if it doesn't exist
            $product = Product::findOrFail($productId); // Ensure the product exists
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image_url' => $product->image_url,
            ];
        }

        // Update the cart in the session
        session()->put('cart.items', $cart);

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }

     
    public function updateCart(Request $request)
{
    $cartItems = json_decode($request->input('cartItems'), true); // Decode the JSON input

    // Get the current session cart
    $sessionCart = session()->get('cart.items', []);
    
    // Update the session cart with new quantities
    foreach ($cartItems as $id => $item) {
        if (isset($sessionCart[$id])) {
            $sessionCart[$id]['quantity'] = $item['quantity']; // Update quantity
        }
    }

    // Save updated cart back to the session
    session()->put('cart.items', $sessionCart);

    return response()->json(['message' => 'Giỏ hàng đã được cập nhật thành công.']);
}



    public function destroy($productId)
    {
        // Retrieve the cart from the session
        $cart = session()->get('cart.items', []);

        // Check if the item exists in the cart
        if (isset($cart[$productId])) {
            unset($cart[$productId]); // Remove the item
            session()->put('cart.items', $cart); // Save back to the session
            return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa thành công.');
        }

        return redirect()->route('cart.index')->with('error', 'Sản phẩm không tồn tại.');
    }
}
