<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;

class UpdateUserFormRequest extends BaseFormRequest
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
            'first_name' => 'nullable|unique:users,first_name,'.auth('user')->user()->id,
            'last_name' => 'nullable|unique:users,last_name,'.auth('user')->user()->id,
            'email' => 'nullable|email|unique:users,email,'.auth('user')->user()->id,
            'gender' => 'nullable|in:male,female',
            'mobile' => 'nullable',
        ];
    }
}
