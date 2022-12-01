<?php

namespace App\Http\Requests\PaymentMethod;

use App\Http\Requests\BaseFormRequest;

class MerchantPaymentMethodFormRequest extends BaseFormRequest
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
            'payment_method_id' => 'required|array',
            'payment_method_id.*' => 'exists:payment_methods,id',
        ];
    }
}
