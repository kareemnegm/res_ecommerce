<?php

namespace App\Http\Requests\Merchant\Product;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

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
    public function rules()
    {
        $auth=auth('merchant')->user()->id;
        return [
            'name.en' => 'required|string',
            'name.ar' => 'required|string',
            'description.en' => 'nullable|string',
            'description.ar' => 'nullable|string',
            'name.*' => 'unique_translation:products,name,'.$auth,
            'price' => 'required|numeric',
            'offer_price' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'stock_quantity' => 'nullable|integer',
            'tags' => 'sometimes|required|array',
            'tags.*' => 'required|string|distinct|min:3',
            'product_images' => 'nullable|array',
            'product_images.*'=>'image|mimes:jpeg,png,jpg,gif,svg|max:20000',
            'weight' => 'nullable|numeric',
            'order' => 'nullable|numeric',
            'merchant_category_id' => 'required|exists:merchant_categories,id,merchant_id,'.$auth,

        ];
    }
}
