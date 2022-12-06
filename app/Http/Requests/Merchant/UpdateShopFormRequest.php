<?php

namespace App\Http\Requests\Merchant;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateShopFormRequest extends BaseFormRequest
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
        $auth_id = auth('api')->user()->id;

        return [
            'id' => 'required|exists:shops,id,user_id,' . $auth_id,
            'shop_name' => '|required|string|unique:shops,shop_name,user_id' . $auth_id,
            "description" => 'required',
            'mobile' => 'required|unique:shops',
            'country_id' => 'required|exists:countries,id',
            'category_id' => 'required|array',
            'category_id.*' => 'required|exists:categories,id',
            'shop_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20000',
        ];
    }
}
