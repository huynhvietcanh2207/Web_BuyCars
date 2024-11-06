<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function indexDetail($id)
    {
        $product = Product::where("ProductId", $id)->firstOrFail();
        return view("detail", compact("product"));
    }

    // public function indexDetail($id)
    // {
    //     $product = Product::where("ProductId", $id)->firstOrFail();
    //     return view("detail", compact("product"));
    // }

}
