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

        $products = Product::with('brand')->paginate(4);

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
        $request->validate([
            'name' => 'required|string|max:255',
            'BrandId' => 'required|integer',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:0',
            'file_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('file_upload')) {
            $originalFilename = $request->file('file_upload')->getClientOriginalName();
            $destinationPath = public_path('images');
            $request->file('file_upload')->move($destinationPath, $originalFilename);
            $imagePath = 'images/' . $originalFilename;
        }

        $product = Product::create([
            'name' => $request->name,
            'BrandId' => $request->BrandId,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image_url' => $imagePath ?? null,
            'description' => $request->description,
            'color' => $request->color,
        ]);

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
        'quantity' => 'required|integer|min:0',
        'file_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'description' => 'nullable|string',
        'color' => 'nullable|string|max:255',
    ]);

    if ($request->hasFile('file_upload')) {
        $originalFilename = $request->file('file_upload')->getClientOriginalName();
        $destinationPath = public_path('images');
        $request->file('file_upload')->move($destinationPath, $originalFilename);
        $product->image_url = 'images/' . $originalFilename;
    }

    $product->update([
        'name' => $request->name,
        'BrandId' => $request->BrandId,
        'price' => $request->price,
        'quantity' => $request->quantity,
        'description' => $request->description,
        'color' => $request->color,
    ]);

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
