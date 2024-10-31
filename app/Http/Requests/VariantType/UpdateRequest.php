<?php

namespace App\Http\Requests\VariantType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Http\Requests\DefaultRequest;

class UpdateRequest extends FormRequest
{

    use DefaultRequest;

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name_en' => [
                'required',
                'string',
                'max:255',
                Rule::unique('variant_types')->ignore($this->variant_type),
            ],
            'name_ar' => [
                'required',
                'string',
                'max:255',
                Rule::unique('variant_types')->ignore($this->variant_type),
            ],
        ];
    }
}
