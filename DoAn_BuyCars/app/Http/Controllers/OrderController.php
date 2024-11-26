<?php

namespace App\Http\Controllers;
<<<<<<< HEAD

use App\Models\Order;
use App\Models\OrderItem;
=======
use App\Models\Order;

use App\Http\Controllers\Controller;
>>>>>>> 10x-laravel-31-OrderDetails
use Illuminate\Http\Request;

class OrderController extends Controller
{
<<<<<<< HEAD
    public function index()
    {
        
        $users = \App\Models\User::all(); 
        $sortBy = request()->get('sort_by', 'asc'); 
        $searchTerm = request()->get('search');    
    
    
        $orders = Order::query()
            ->when($searchTerm, function ($query, $searchTerm) {
                $query->whereHas('user', function ($userQuery) use ($searchTerm) {
                    $userQuery->where('name', 'like', '%' . $searchTerm . '%');
                });
            })
            ->orderBy('OrderDate', $sortBy) 
            ->paginate(4); 
    
        return view('admin.orders.index', compact('orders','users'));
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
=======
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

>>>>>>> 10x-laravel-31-OrderDetails
}
