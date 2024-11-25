<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';

    protected $fillable = [
        'BrandName',
        'image_url',
    ];

    protected $primaryKey = 'BrandId';

    public function listBrand()
    {
        return Brand::orderBy('BrandId', 'desc')->get();
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'BrandId');
    }
}
