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
        $auth_id = auth('api')->user()->id;
        return [
            'shop_id' => 'required|exists:shops,id,user_id,' . $auth_id,
            'product_id' => 'required|exists:products,id,shop_id,' . $request->shop_id,
            'name' => 'required|string|unique:products,name,'.$request->shop_id,
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'offer_price' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'stock_quantity' => 'nullable|integer',
            'tags' => 'sometimes|required|array',
            'tags.*' => 'required|string|distinct|min:3',
            'deleted_tags' => 'sometimes|required|array',
            'deleted_images' => 'sometimes|required|array',
            'product_images' => 'nullable|array',
            'product_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20000',
            'weight' => 'nullable|numeric',
            'order' => 'nullable|numeric',
            "is_published" => 'required|in:1,0',
            'shop_category_id' => 'required|exists:shop_categories,id,shop_id,'.$request->shop_id,

        ];
    }
}
