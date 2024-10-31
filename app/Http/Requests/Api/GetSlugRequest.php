<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;


class GetSlugRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'lang' => 'nullable|in:en,ar',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'lang.in' => 'The language must be either en or ar.',
            'product_id.required' => 'The product ID is required.',
            'product_id.exists' => 'The product ID does not exist.',
        ];
    }
}