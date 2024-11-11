<?php

namespace App\Http\Requests\Admin\Category;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class AdminCategoryUpdateRequest extends BaseFormRequest
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
        $categoryId = $this->route('category');

        return [
            'name' => [
                'required',
                'string',
                Rule::unique('categories', 'name')->ignore($categoryId),
                'lowercase',
                'min:3',
                'max:256'
            ]
        ];
    }
}
