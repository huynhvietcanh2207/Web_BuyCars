<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $users = \App\Models\User::all(); 

        $orders = Order::paginate(10);
        return view('admin.orders.index', compact('orders', 'users'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'OrderStatus' => $request->input('OrderStatus'),
        ]);
        return redirect()->route('orders.index');
    }

    public function create()
    {
        $users = \App\Models\User::all(); 
    
        return view('admin.orders.create', compact('users'));
    }
    

    public function store(Request $request)
    {
        $order = new Order;

        $order->OrderDate = $request->input('OrderDate');
        // $order->TotalAmount = $request->input('TotalAmount');
        $order->OrderStatus = $request->input('OrderStatus');
        $order->user_id = $request->input('user_id');  // Lấy user_id từ form

        $order->save();
        session()->flash('success', 'Đơn hàng đã được tạo thành công!');

        return redirect()->route('orders.index');
    }


    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        session()->flash('success', 'Đơn hàng đã được xóa thành công!');

        return redirect()->route('orders.index');
    }
}
