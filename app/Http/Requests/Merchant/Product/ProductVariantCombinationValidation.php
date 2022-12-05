<?php

namespace App\Http\Requests\Merchant\Product;

use App\Http\Requests\BaseFormRequest;
use App\Rules\ProductVairantRule;

class ProductVariantCombinationValidation extends BaseFormRequest
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
            'product_id' => ['required', 'exists:products,id', new ProductVairantRule()],
            'product_combination_id' => 'required|exists:product_combinations,id,product_id,'.request()->product_id,
            'stock' => 'sometimes|required|numeric',
            'price' => 'sometimes|required|numeric',
        ];
    }
}
