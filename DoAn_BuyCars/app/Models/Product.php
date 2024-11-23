<?php

namespace App\Models;
use App\Helpers\IdEncoder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products'; // Tên bảng trong database
    protected $primaryKey = 'ProductId';

    // Các trường có thể được thêm hoặc chỉnh sửa
    protected $fillable = ['name', 'BrandId', 'price','quantity','description', 'image_url', 'color'];

    public function brand()
    {   
        return $this->belongsTo(Brand::class, 'BrandId');
    }   
    public function getEncodedId()
    {
        return IdEncoder::encodeId($this->ProductId);
    }
}
