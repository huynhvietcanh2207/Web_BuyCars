<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function indexDetail($id)
    {
        $product = Product::with('brand')->where("ProductId", $id)->firstOrFail();
        return view("detail", compact("product"));
    }

    

}
