<?php
namespace App\Http\Requests\VariantType;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\DefaultRequest;

class StoreRequest extends FormRequest
{
    use DefaultRequest;

    public function rules(): array
    {
        return [
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ];
    }
}
