<?php

namespace App\Http\Requests\Merchant;

use App\Http\Requests\BaseFormRequest;

class UpdateFormRequest extends BaseFormRequest
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
        $auth_id=auth('merchant')->user()->id;
        return [
            'email' => 'required|email|unique:merchants,email,'.$auth_id,
            'shop_name.en' => 'required|string',
            'shop_name.ar' => 'required|string',
            'shop_name.*' => 'unique_translation:merchants,shop_name,'.$auth_id,
            'description.*' => 'unique_translation:merchants,description,'.$auth_id,
            "description.en" => 'required|string',
            "description.ar" => 'required|string',
            'country_id' => 'nullable|exists:countries,id',
            'category_id' => 'required|array',
            'category_id.*' => 'required|exists:categories,id',
            'shop_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20000',
        ];
    }
}
