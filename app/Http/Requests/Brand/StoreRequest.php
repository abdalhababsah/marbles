<?php

namespace App\Http\Requests\Brand;

use App\Http\Requests\DefaultRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
   use DefaultRequest;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_en' => 'required|string|max:255',
            'icon_path' => 'nullable|file|image|max:2048', 
            'sort_order' => 'required|integer|unique:brands,sort_order',
        ];
    }

        /**
     * Get custom messages for validator errors.
     *
     * @return array
     */

}
