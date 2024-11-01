<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = (new Brand)->listBrand();
        $title = 'Danh sách thương hiệu';

        return view('brands.index', [
            'brands' => $brands,
            'title' => $title
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($BrandId)
    {
        $brands = (new Brand)->listBrand();

        // Tìm thương hiệu theo ID
        $brand = Brand::where('BrandId', $BrandId)->firstOrFail();

        // Lấy danh sách sản phẩm liên quan đến thương hiệu
        $products = Product::where('BrandId', $brand->BrandId)->paginate(perPage: 8);

        $title = 'Sản phẩm của thương hiệu: ' . $brand->BrandName;

        return view('brands.show', [
            'brands' => $brands,
            'brand' => $brand,
            'products' => $products,
            'title' => $title
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
    }
}