<?php

namespace App\Http\Requests\Brand;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Http\Requests\DefaultRequest;

class UpdateRequest extends FormRequest
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
            'sort_order' => [
                'required',
                'integer',
                // ensures that the order value is unique across all brands except the one being updated.
                Rule::unique('brands')->ignore($this->brand)
            ], 
        ];
    }
}
