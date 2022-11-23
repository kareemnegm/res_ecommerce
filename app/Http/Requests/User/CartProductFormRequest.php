<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;
use App\Rules\ProductStockRule;
use App\Rules\ShopInCartRule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CartProductFormRequest extends BaseFormRequest
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

        $request['user_id'] = auth('user')->user()->id;

        return [
            'merchant_id' => [
                'required',

                Rule::exists('products', 'merchant_id')
                    ->where('id', $request->product_id)->where('merchant_id', $request->merchant_id),

                new ShopInCartRule($request)
            ],
            'product_id' => 'required|exists:products,id',
            'quantity' => ['required', 'integer', new ProductStockRule($request)]

        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'merchant_id.exists' => 'The selected product merchant id is invalid.',
        ];
    }
}
