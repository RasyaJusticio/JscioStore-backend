<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\AdminCategoryStoreRequest;
use App\Http\Requests\Admin\Category\AdminCategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->success(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminCategoryStoreRequest $request)
    {
        $fields = $request->validated();

        Category::create($fields);

        return $this->success('Category created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $this->success($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminCategoryUpdateRequest $request, Category $category)
    {
        $fields = $request->validated();

        $category->update($fields);

        return $this->success('Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return $this->success('Category deleted successfully');
    }
}
