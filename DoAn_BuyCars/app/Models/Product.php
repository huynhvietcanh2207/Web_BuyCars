<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products'; // Tên bảng trong database
    protected $primaryKey = 'ProductId'; // Tên cột khóa chính

    // Các trường có thể được thêm hoặc chỉnh sửa
    protected $fillable = ['name', 'BrandId', 'price', 'description', 'image_url', 'color'];
}
