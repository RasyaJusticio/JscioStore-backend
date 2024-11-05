<?php

namespace App\Http\Requests\Admin\Product;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class AdminProductUpdateRequest extends BaseFormRequest
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
        $productId = $this->route('product');

        return [
            'name' => [
                'nullable',
                Rule::unique('products', 'name')->ignore($productId),
                'string',
                'between:5,80'
            ],
            'description' => ['nullable', 'string', 'between:5,1500'],
            'price' => ['nullable', 'decimal:0,2', 'between:0,999999999.99'],
            'stock' => ['nullable', 'numeric', 'min:0']
        ];
    }
}
