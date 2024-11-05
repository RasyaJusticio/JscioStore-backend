<?php

namespace App\Http\Requests\Admin\Product;

use App\Http\Requests\BaseFormRequest;

class AdminProductStoreRequest extends BaseFormRequest
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
        return [
            'name' => ['required', 'unique:products,name', 'string', 'between:5,80'],
            'description' => ['required', 'string', 'between:5,1500'],
            'price' => ['required', 'decimal:0,2', 'between:0,999999999.99'],
            'stock' => ['nullable', 'numeric', 'min:0'],
            'categories' => ['required', 'array', 'min:1'],
            'categories.*' => ['required', 'numeric', 'exists:categories,id'],
        ];
    }
}
