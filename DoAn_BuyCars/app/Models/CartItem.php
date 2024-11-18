<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cart_items';

    protected $primaryKey = 'CartItemId';

    public $timestamps = false;
    protected $fillable = ['CartItemId', 'UserId', 'ProductId', 'quantity', 'price', 'updated_at'];

    public function product(){
        return $this->belongsTo(Product::class, 'ProductId', 'ProductId');
    }


    //Lấy tất cả sản phẩm của người dùng
    public static function getUserCartItems($userId)
    {
        return self::with('product')
            ->where('UserId', $userId)
            ->orderBy('updated_at', 'desc');
    }

    //Xóa sản phẩm theo ID
    public static function deleteProductID($cartItemId)
    {
        return self::where('CartItemId', $cartItemId)->delete();
    }

    // Xóa nhiều sản phẩm theo danh sách ID
    public static function deleteProductListID($cartItemIds)
    {
        return self::whereIn('CartItemId', $cartItemIds)->delete();
    }

    // Cập nhật số lượng và tính giá mới
    public static function updateCartItem($cartItemId, $quantity)
    {
        $cartItem = self::with('product')->find($cartItemId);
        if ($cartItem) {
            $newPrice = $cartItem->product->price * $quantity;

            self::where('CartItemId', $cartItemId)->update([
                'quantity' => $quantity,
                'price' => $newPrice,
            ]);

            return self::find($cartItemId);
        }
        return null;
    }

    // Thêm sản phẩm vào giỏ hàng
    public static function addOrUpdateCartItem($userId, $productId, $quantity = 1)
    {
        $cartItem = self::where('UserId', $userId)
            ->where('ProductId', $productId)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $quantity;
            $newPrice = $cartItem->product->price * $newQuantity;

            self::where('CartItemId', $cartItem->CartItemId)->update([
                'quantity' => $newQuantity,
                'price' => $newPrice,
            ]);
        } else {
            $product = Product::find($productId);
            self::insert([
                'UserId' => $userId,
                'ProductId' => $productId,
                'quantity' => $quantity,
                'price' => $product->price * $quantity,
            ]);
        }
    }

    public static function calculateTotalPrice($userId)
    {
        return self::where('UserId', $userId)->sum(DB::raw('quantity * price'));
    }
}
