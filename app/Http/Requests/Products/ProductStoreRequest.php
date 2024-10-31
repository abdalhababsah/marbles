<?php

namespace App\Http\Requests\Products;

use App\Http\Requests\DefaultRequest;
use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    use DefaultRequest;

    public function rules(): array
    {
        return [
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:active,inactive',
            // Define rules for dimensions
            'dimensions.length' => 'required|numeric',
            'dimensions.width' => 'required|numeric',
            'dimensions.height' => 'required|numeric',
            'quantity_available' => 'required|numeric',
            'category_type' => 'required|in:normal,new,hot,featured',

            'dimensions.dimension_unit' => 'required|string|max:10',
            // Define rules for variants and images
            'variants.*.variant_type_id' => 'required|exists:variant_types,id',
            'variants.*.variant_value_en' => 'required|string|max:255',
            'variants.*.variant_value_ar' => 'required|string|max:255',
            'images.*' => 'required|image|max:2048',
        ];
    }
}
