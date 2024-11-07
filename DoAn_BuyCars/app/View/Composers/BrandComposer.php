<?php

namespace App\View\Composers;

use App\Models\Brand;
use Illuminate\View\View;

class BrandComposer
{
    /**
     * The Brand model implementation.
     *
     * @var \Illuminate\Database\Eloquent\Collection
     */
    protected $brands;

    /**
     * Create a new Brand composer.
     */
    public function __construct()
    {
        $this->brands = (new Brand)->listBrand(); // Lấy danh sách thương hiệu
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('sidebar_brands', $this->brands); // Truyền danh sách thương hiệu vào view
    }
}