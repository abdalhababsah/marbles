<?php

namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ArrayOfCategoryIds implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!is_array($value)) {
            return false;
        }

        foreach ($value as $categoryId) {
            if (!is_numeric($categoryId) || $categoryId <= 0) {
                return false;
            }
            // You can add more validation logic here if needed
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be an array of valid category IDs.';
    }
}
