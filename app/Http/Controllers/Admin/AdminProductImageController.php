<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductImage\AdminProductImageStoreRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductImageController extends Controller
{
    public function index(Product $product)
    {
        return $this->success('Product images fetched successfully', $product->images);
    }

    public function store(Product $product, AdminProductImageStoreRequest $request)
    {
        $fields = $request->validated();

        foreach ($fields['images'] as $image) {
            $imageName = $image->hashName();

            if ($url = Storage::disk('public')->putFileAs('images/product', $image, $imageName)) {
                $product->images()->create([
                    'url' => $url,
                ]);
            }
        }

        return $this->success('Product images uploaded successfully');
    }

    public function destroy(Product $product, ProductImage $productImage)
    {
        //
    }
}
