<?php

namespace App\Http\Controllers;
use App\Models\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //kiem tra dang nhap
    public function __construct()
{
    $this->middleware('auth'); // Chỉ cho phép người dùng đã đăng nhập
}

    //lich su thanh toan
    public function history()
{
    $userId = auth()->id(); // Lấy ID của người dùng hiện tại
    $orders = Order::where('user_id', $userId)
                   ->orderBy('payment_date', 'desc')
                   ->with('items.product')
                   ->get();

    return view('order.history', compact('orders'));
}

//hien thi thong tin chi tiet order
    public function show($id)
{
    $order = Order::with('items.product')->findOrFail($id);
    return view('order.info', compact('order'));
}

}
