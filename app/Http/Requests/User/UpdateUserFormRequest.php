<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;
use App\Rules\UserIdNumberValidatorRule;
use Illuminate\Http\Request;

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
    public function rules(Request $request)
    {
        return [
            'full_name' => 'required|string|unique:users,full_name,'.auth('user')->user()->id,
            'email' => 'nullable|email|unique:users,email,'.auth('user')->user()->id,
            'gender' => 'nullable|in:male,female',
            'mobile' => 'nullable',
            'date_of_birth' =>'required|date_format:Y-m-d|before:today',
        ];
    }
}
