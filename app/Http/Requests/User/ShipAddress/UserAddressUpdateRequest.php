<?php

namespace App\Http\Requests\User\ShipAddress;

use Illuminate\Foundation\Http\FormRequest;

class UserAddressUpdateRequest extends FormRequest
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
            'default' => ['nullable', 'boolean'],
            'address' => ['nullable', 'string', 'min:8', 'max:256'],
        ];
    }
}
