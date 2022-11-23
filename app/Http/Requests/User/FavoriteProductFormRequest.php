<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;
use App\Models\Product;
use App\Rules\ProductInFavoriteRule;
use App\Rules\ProductStockRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class FavoriteProductFormRequest extends BaseFormRequest
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
            'merchant_id' => 'required|exists:merchants,id',
            'product_id' => ['required','exists:products,id,merchant_id,'.$request->merchant_id,new ProductInFavoriteRule($request)]
        ];
    }
}
