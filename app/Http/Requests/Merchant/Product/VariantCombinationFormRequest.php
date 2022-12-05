<?php

namespace App\Http\Requests\Merchant\Product;

use App\Http\Requests\BaseFormRequest;

class VariantCombinationFormRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'variant_value.*' => 'required|exists:variant_values,id',
            'stock' => 'required|integer',
            'price' => 'required',
            'product_id' => 'required|exists:products,id',
        ];
    }
}
