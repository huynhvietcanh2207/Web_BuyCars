<?php
<<<<<<< HEAD
namespace App\Models;

=======

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> 10x-laravel-31-OrderDetails
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
<<<<<<< HEAD
    protected $primaryKey = 'OrderId';

    protected $fillable = ['OrderDate', 'TotalAmount', 'OrderStatus'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'OrderId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');  
    }
=======
    use HasFactory;
>>>>>>> 10x-laravel-31-OrderDetails
}
