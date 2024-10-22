<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $table = 'favorites'; // Bảng tương ứng
    protected $fillable = [
        'user_id', // Thêm user_id vào đây
        'ProductId'
    ];


    // Quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // user_id là khóa ngoại
    }

    // Quan hệ với Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductId'); // ProductId là khóa ngoại
    }
}
