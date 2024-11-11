<?php

namespace App\Http\Requests\Admin\ProductImage;

use App\Http\Requests\BaseFormRequest;

class AdminProductImageStoreRequest extends BaseFormRequest
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
            'images' => ['required', 'array', 'min:1'],
            'images.*' => [
                'required',
                'image',
                'mimes:jpg,png,jpeg,webp',
                'max:10240',
                'dimensions:max_width=2560,max_height=2560,ratio=1/1'
            ],
        ];
    }
}
