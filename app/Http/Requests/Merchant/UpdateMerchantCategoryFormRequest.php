<?php

namespace App\Http\Requests\Merchant;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateMerchantCategoryFormRequest extends BaseFormRequest
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

        $auth_id= auth('user')->user()->id;
        return [
            'category_id' => 'required|exists,shop_categories,id,shop_id,' . $request->shop_id,
            'shop_id' => 'required|exists:shops,id,user_id,' .$auth_id,
            'name' => 'required|string',
            'shop_category_id' => 'nullable|exists:shop_categories,id,shop_id,' .$auth_id
        ];
    }
}
