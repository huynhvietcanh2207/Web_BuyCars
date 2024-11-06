<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class CrudProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::paginate(4);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();

        return view('admin.products.crud', compact('brands'));
    }



    /**
     * Store a newly created resource in storage.
     */
    // Trong controller thêm sản phẩm

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'BrandId' => 'required|integer',
            'price' => 'required|numeric',
            'file_upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('file_upload')) {
            // Lấy tên gốc của file
            $originalFilename = $request->file('file_upload')->getClientOriginalName();
            $destinationPath = public_path('images');
            $request->file('file_upload')->move($destinationPath, $originalFilename);
            $imagePath = 'images/' . $originalFilename;
        }

        // Create a new product in the database
        $product = Product::create([
            'name' => $request->name,
            'BrandId' => $request->BrandId,
            'price' => $request->price,
            'image_url' => $imagePath ?? null,

            'description' => $request->description,
            'color' => $request->color,
        ]);
        //cacsh 1
        // Gửi email thông báo đến người dùng đã đăng ký
        $subscribers = Subscription::all();
        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new \App\Mail\ProductAdded($product));
        }
        //cacsh 2
        // $subscribers = Subscription::all();
        // foreach ($subscribers as $subscriber) {
        //     try {
        //         $emailContent = 'Một sản phẩm mới của website Buycars đã được thêm: ' . $product->name;
        //         Mail::raw($emailContent, function ($message) use ($subscriber) {
        //             $message->to($subscriber->email)
        //                 ->subject('Thông báo sản phẩm mới');
        //         });

        //         // Ghi log để kiểm tra xem email đã gửi hay chưa
        //         \Log::info('Email đã được gửi đến: ' . $subscriber->email);
        //     } catch (\Exception $e) {
        //         \Log::error('Gửi email thất bại đến ' . $subscriber->email . ': ' . $e->getMessage());
        //     }
        // }

        //cacsh 3
        // Mail::raw('Nội dung email thử nghiệm', function ($message) {
        //     $message->to('huynhvietcanh2004@gmail.com') // Thay thế bằng địa chỉ email bạn muốn gửi đến
        //         ->subject('Tiêu đề email thử nghiệm');
        // });

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được thêm thành công!');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $product = Product::findOrFail($id);
    $brands = Brand::all();
    return view('admin.products.edit', compact('product', 'brands'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
    
        $request->validate([
            'name' => 'required|string|max:255',
            'BrandId' => 'required|integer',
            'price' => 'required|numeric',
            'file_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:255',
        ]);
    
        // Cập nhật hình ảnh nếu có file mới được tải lên
        if ($request->hasFile('file_upload')) {
            $originalFilename = $request->file('file_upload')->getClientOriginalName();
            $destinationPath = public_path('images');
            $request->file('file_upload')->move($destinationPath, $originalFilename);
            $product->image_url = 'images/' . $originalFilename;
        }
    
        $product->name = $request->name;
        $product->BrandId = $request->BrandId;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->color = $request->color;
        $product->save();
    
        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật thành công!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
    
        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được xóa thành công!');
    }
}
