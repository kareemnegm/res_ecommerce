<?php

namespace App\Http\Requests\Merchant\ShopCategory;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ShopCategoryIdValidation extends BaseFormRequest
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
        return [
            'shop_id'=>'required|exists:shops,id,user_id,'.auth('api')->user()->id,
            'shop_category_id'=>'required|exists:shop_categories,id,shop_id,'.$request->shop_id,
        ];
    }
}
