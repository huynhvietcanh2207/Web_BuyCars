<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['Name', 'BrandId', 'Price', 'Description', 'ImageUrl', 'Color'];

    // Quan hệ one-to-many với Comment
    public function comments()
    {
        return $this->hasMany(Comment::class, 'ProductId', 'id');
    }
}