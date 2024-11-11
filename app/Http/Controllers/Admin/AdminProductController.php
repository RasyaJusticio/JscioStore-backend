<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\AdminProductStoreRequest;
use App\Http\Requests\Admin\Product\AdminProductUpdateRequest;
use App\Models\Product;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->success(
            'Products fetched successfully',
            Product::query()->with(['categories', 'images'])->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminProductStoreRequest $request)
    {
        $fields = $request->validated();

        $product = Product::create($fields);

        foreach ($fields['categories'] as $categoryId) {
            $product->categories()->attach($categoryId);
        }

        return $this->success('Product created successfully', status: 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $this->success('Product fetched successfully', $product->load(['categories', 'images']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminProductUpdateRequest $request, Product $product)
    {
        $fields = $request->validated();

        $product->update($fields);

        return $this->success('Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return $this->success('Product deleted successfully');
    }
}
