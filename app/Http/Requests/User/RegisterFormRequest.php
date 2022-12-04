<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;
use App\Rules\UserIdNumberValidatorRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
    public function rules(Request $request)
    {
        return [
            'full_name' => 'required|string|unique:users',
            'id_number' => ['required','numeric','unique:users', new UserIdNumberValidatorRule($request)],
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
            'date_of_birth' =>[Rule::requiredIf(!auth()->user()),'date_format:Y-m-d|before:today'],
            'gender' => [Rule::requiredIf(!auth()->user()),'in:male,female'],
            'country_code' => 'nullable',
            'mobile' => 'required|unique:users',
            'country_id' => 'required|exists:countries,id'
        ];
    }
}
