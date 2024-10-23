<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['Name', 'BrandId', 'Price', 'Description', 'ImageUrl', 'Color'];
}