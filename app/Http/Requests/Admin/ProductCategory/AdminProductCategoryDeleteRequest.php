<?php

namespace App\Http\Requests\Admin\ProductCategory;

use App\Http\Requests\BaseFormRequest;
use App\Rules\ProductCategoryIsLinked;

class AdminProductCategoryDeleteRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $product = $this->route('product');

        return [
            'categories' => ['required', 'array', 'min:1'],
            'categories.*' => ['required', 'numeric', 'exists:categories,id', new ProductCategoryIsLinked($product)],
        ];
    }
}
