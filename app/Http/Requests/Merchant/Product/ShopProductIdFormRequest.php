<?php

namespace App\Http\Requests\Merchant\Product;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ShopProductIdFormRequest extends BaseFormRequest
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
        ];
    }
}
