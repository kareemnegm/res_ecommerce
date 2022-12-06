<?php

namespace App\Http\Requests\Merchant;

use App\Http\Requests\BaseFormRequest;

class RegisterShopFormRequest extends BaseFormRequest
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
        return [
            'shop_name' => 'required|string',
            // 'shop_name.ar' => 'required|string',
            'shop_name' => 'unique:shops,shop_name',
            "description" => 'required',
            'mobile' => 'required|unique:shops',
            'country_id' => 'required|exists:countries,id',
            'category_id' => 'required|array',
            'category_id.*' => 'required|exists:categories,id',
            'shop_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20000',
        ];
    }
}
