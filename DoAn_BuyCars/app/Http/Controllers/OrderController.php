<?php

namespace App\Http\Controllers;
use App\Models\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function show($id)
{
    $order = Order::with('items.product')->findOrFail($id);
    return view('order.info', compact('order'));
}

}
