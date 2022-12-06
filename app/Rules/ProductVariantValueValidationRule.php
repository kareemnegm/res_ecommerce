<?php

namespace App\Rules;

use App\Models\Product;
use App\Models\VariantValue;
use Illuminate\Contracts\Validation\Rule;

class ProductVariantValueValidationRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $variantValue = VariantValue::where('id', $value)->first();
        $variantProductId = $variantValue->productVariant->product_id;
        if ($this->request->product_id == $variantProductId) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'not valid variant value ID';
    }
}
