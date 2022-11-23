<?php

namespace App\Http\Requests\Merchant\Product;

use App\Http\Requests\BaseFormRequest;
use App\Rules\MerchantProductValidationRule;
use Illuminate\Http\Request;

class UpdateProductFormRequest extends BaseFormRequest
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
    public function rules(Request $request)
    {
        $auth=auth('merchant')->user()->id;
        return [
            'id' => ['required','exists:products,id',new MerchantProductValidationRule()],
            'name.en' => 'required|string',
            'name.ar' => 'required|string',
            'description.en' => 'nullable|string',
            'description.ar' => 'nullable|string',
            'name.*' => 'unique_translation:products,name,'.$request->id,
            'price' => 'required|numeric',
            'offer_price' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'stock_quantity' => 'nullable|integer',
            'tags' => 'sometimes|required|array',
            'tags.*' => 'required|string|distinct|min:3',
            'deleted_tags' => 'sometimes|required|array',
            'deleted_images' => 'sometimes|required|array',
            'product_images' => 'nullable|array',
            'product_images.*'=>'image|mimes:jpeg,png,jpg,gif,svg|max:20000',
            'weight' => 'nullable|numeric',
            'order' => 'nullable|numeric',
            'merchant_category_id' => 'required|exists:merchant_categories,id,merchant_id,'.$auth,

        ];
    }
}
