<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function listBrand()
    {
        return Brand::orderBy('BrandId', 'desc')->get();
    }
}