<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductCategory\AdminProductCategoryDeleteRequest;
use App\Http\Requests\Admin\ProductCategory\AdminProductCategoryStoreRequest;
use App\Models\Product;
use App\Models\ProductCategory;

class AdminProductCategoryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Product $product, AdminProductCategoryStoreRequest $request)
    {
        $fields = $request->validated();

        foreach ($fields['categories'] as $category) {
            $product->categories()->attach($category);
        }

        return $this->success('Product categories updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, AdminProductCategoryDeleteRequest $request)
    {
        $fields = $request->validated();

        foreach ($fields['categories'] as $category) {
            $product->categories()->detach($category);
        }

        return $this->success('Product categories updated successfully');
    }
}
