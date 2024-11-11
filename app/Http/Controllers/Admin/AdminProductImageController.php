<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class AdminProductImageController extends Controller
{
    public function index(Product $product)
    {
        return $this->success('Product images fetched successfully', $product->images);
    }

    public function store(Product $product)
    {
        //
    }

    public function destroy(Product $product, ProductImage $productImage)
    {
        //
    }
}
