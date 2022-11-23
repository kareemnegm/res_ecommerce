<?php

namespace App\Http\Requests\Merchant;

use App\Http\Requests\BaseFormRequest;

class MerchantCategoryFormRequest extends BaseFormRequest
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
            'name.en' => 'required|string',
            'name.ar' => 'required|string',
            'name.*' => 'unique_translation:categories,name',
            'merchant_category_id' => 'nullable|exists:merchant_categories,id',
        ];
    }
}
