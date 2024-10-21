<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscriptions'; // Đặt tên bảng nếu khác với mặc định

    protected $fillable = ['email']; // Cho phép mass assignment
}
