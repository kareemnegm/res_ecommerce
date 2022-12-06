<?php

namespace App\Http\Requests\Merchant\Product;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductFormRequest extends BaseFormRequest
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
        $auth=auth('api')->user()->id;
        return [
            'shop_id'=>'required|exists:shops,id,user_id,'.$auth,
            'name' => 'required|string|unique:products,name,'.$request->shop_id,
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'offer_price' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'stock_quantity' => 'nullable|integer',
            'tags' => 'sometimes|required|array',
            'tags.*' => 'required|string|distinct|min:3',
            'product_images' => 'nullable|array',
            'product_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20000',
            'weight' => 'nullable|numeric',
            'order' => 'nullable|numeric',
            "is_published"=>'required|in:1,0',
            'shop_category_id' => 'required|exists:shop_categories,id,shop_id,'.$request->shop_id,

        ];
    }
}
