<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;

class PaymentMethodFromRequest extends BaseFormRequest
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
            'name.*' => 'unique_translation:merchants,shop_name',
            'payment_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20000',
            'status' => 'required|in:1,0',
        ];
    }
}
