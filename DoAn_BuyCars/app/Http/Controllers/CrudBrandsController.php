<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class CrudBrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sortBy = request()->get('sort_by', 'asc'); 
        $searchTerm = request()->get('search'); 
    
        $brands = Brand::query()
            ->when($searchTerm, function ($query, $searchTerm) {
                $query->whereFullText('BrandName', $searchTerm); // Sử dụng Fulltext search
            })
            ->orderBy('created_at', $sortBy)
            ->paginate(4);
    
        return view('admin.brands.index', compact('brands'));
    }
    



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();

        return view('admin.brands.crud', compact('brands'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'BrandName' => 'required|string|min:5|max:50',  // Ràng buộc cho tên thương hiệu
            'file_upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Ràng buộc cho hình ảnh
        ]);

        if ($request->hasFile('file_upload')) {
            // Lấy tên gốc của file
            $originalFilename = $request->file('file_upload')->getClientOriginalName();
            $destinationPath = public_path('images');
            $request->file('file_upload')->move($destinationPath, $originalFilename);
            $imagePath = 'images/' . $originalFilename;
        }

        Brand::create([
            'BrandName' => $request->BrandName,
            'image_url' => $imagePath ?? null,
        ]);

        return redirect()->route('brands.index')->with('success', 'Thương hiệu đã được thêm thành công!');
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
        $brand = Brand::findOrFail($id); // Tìm thương hiệu theo ID
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'BrandName' => 'required|string|min:5|max:50',  // Ràng buộc cho tên thương hiệu
            'file_upload' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Ràng buộc cho hình ảnh
        ]);

        $brand = Brand::findOrFail($id);
        $brand->BrandName = $request->BrandName;

        if ($request->hasFile('file_upload')) {
            $originalFilename = $request->file('file_upload')->getClientOriginalName();
            $destinationPath = public_path('images');
            $request->file('file_upload')->move($destinationPath, $originalFilename);
            $imagePath = 'images/' . $originalFilename;
            $brand->image_url = $imagePath; // Cập nhật đường dẫn hình ảnh
        }

        $brand->save();

        return redirect()->route('brands.index')->with('success', 'Thương hiệu đã được cập nhật thành công!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id); // Tìm thương hiệu theo ID
        $brand->delete();
        return redirect()->route('brands.index')->with('success', 'Thương hiệu đã được xóa thành công!');
    }
}
