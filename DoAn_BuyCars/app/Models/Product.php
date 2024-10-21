<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'ProductId';

    public $incrementing = false;
    
    protected $fillable = ['ProductId', 'name', 'BrandId', 'price', 'description', 'image_url', 'color', 'created_at', 'updated_at'];
}
