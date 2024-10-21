<?php

namespace App\Http\Controllers;
use App\Models\Product; 
use App\Models\Brand; 

use Illuminate\Http\Request;

class CrudProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

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
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'BrandId' => 'required|integer',
            'price' => 'required|numeric',
            'file_upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate file upload
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:255',
        ]);
    
        // Handle file upload
        if ($request->hasFile('file_upload')) {
            $imagePath = $request->file('file_upload')->store('images', 'public'); // Lưu hình ảnh vào thư mục public/images
        }
    
        // Create a new product in the database
        Product::create([
            'name' => $request->name,
            'BrandId' => $request->BrandId,
            'price' => $request->price,
            'image_url' => $imagePath ?? null, // Lưu đường dẫn hình ảnh
            'description' => $request->description,
            'color' => $request->color,
        ]);
    
        // Redirect back to the product list with a success message
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
