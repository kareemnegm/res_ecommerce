<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class VerifyCodeRequest extends BaseFormRequest
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
            'email' => [Rule::requiredIf(!$this->get('phone_number')), 'email'],
            'phone_number' => [Rule::requiredIf(!$this->get('email')),],
            'code' => ['required', 'min:4', 'max:4']
        ];
    }
}
