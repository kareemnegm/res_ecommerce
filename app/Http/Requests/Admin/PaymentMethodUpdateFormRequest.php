<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Http\Request;

class PaymentMethodUpdateFormRequest extends BaseFormRequest
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
            'id' => ['required', 'exists:payment_methods,id'],
            'name.en' => 'required|string',
            'name.ar' => 'required|string',
            'name.*' => 'unique_translation:merchants,shop_name,', $request->id,
            'payment_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20000',
            'status' => 'required|in:1,0',
        ];
    }
}
