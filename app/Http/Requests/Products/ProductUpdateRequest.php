<?php
namespace App\Http\Requests\Products;

use App\Http\Requests\DefaultRequest;
use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    use DefaultRequest;


    public function rules(): array
    {
        return [
            'name_en' => 'sometimes|required|string|max:255',
            'name_ar' => 'sometimes|required|string|max:255',
            'description_en' => 'sometimes|required|string',
            'description_ar' => 'sometimes|required|string',
            'category_id' => 'sometimes|required|exists:categories,id',
            'status' => 'sometimes|required|in:active,inactive',
            // Rules for dimensions
            'dimensions.length' => 'sometimes|required|numeric',
            'dimensions.width' => 'sometimes|required|numeric',
            'dimensions.height' => 'sometimes|required|numeric',
            'dimensions.dimension_unit' => 'sometimes|required|string|max:10',
            // Rules for variants and images
            'variants.*.id' => 'sometimes|exists:variants,id', // For identifying existing variants
            'variants.*.variant_type_id' => 'required_with:variants.*.id|exists:variant_types,id',
            'variants.*.variant_value_en' => 'required_with:variants.*.id|string|max:255',
            'variants.*.variant_value_ar' => 'required_with:variants.*.id|string|max:255',
            'images.*' => 'sometimes|image|max:2048', // Assuming you want to upload images, adjust accordingly
            'removed_images' => 'sometimes|array', // IDs of images to remove
            'removed_variants' => 'sometimes|array', // IDs of variants to remove
        ];
    }
}
