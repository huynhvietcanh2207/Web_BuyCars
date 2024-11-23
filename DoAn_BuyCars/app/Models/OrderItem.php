<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $primaryKey = 'OrderItemId';

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductId');
    }
}
