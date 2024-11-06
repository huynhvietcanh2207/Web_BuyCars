<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
