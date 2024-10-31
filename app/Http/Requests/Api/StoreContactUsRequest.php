<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\DefaultRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreContactUsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    use DefaultRequest;


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'number' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ];
    }
}
