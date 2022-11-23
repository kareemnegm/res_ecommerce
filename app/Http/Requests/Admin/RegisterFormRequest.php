<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;

class RegisterFormRequest extends BaseFormRequest
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
            'name' => 'required|string|unique:admins',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:8',

        ];
    }
}
