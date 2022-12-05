<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;

class MerchantRegisterFormRequest extends BaseFormRequest
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
            'email' => 'required|email|unique:merchants,email',
            'shop_name.en' => 'required|string',
            'shop_name.ar' => 'required|string',
            'shop_name.*' => 'unique_translation:merchants,shop_name',
            'password' => 'required',
            'description.en' => 'required',
            'description.ar' => 'required',
            'description.*' => 'unique_translation:merchants,description',
            'country_code' => 'required',
            'mobile' => 'required|numeric|unique:merchants,mobile',
            'country_id' => 'required|exists:countries,id',
            'category_id' => 'required|array',
            'category_id.*' => 'required|exists:categories,id',
            'shop_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20000',
        ];
    }
}
