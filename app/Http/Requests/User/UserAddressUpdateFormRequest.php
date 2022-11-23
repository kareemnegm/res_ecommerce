<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;
use App\Rules\UserAddressRule;

class UserAddressUpdateFormRequest extends BaseFormRequest
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
            'id' => ['required', 'exists:user_addresses,id', new UserAddressRule()],
            'address' => 'required|string',
            'street' => 'required|string',
            'nearest_landmark' => 'required|string',
            'mobile' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'notes' => 'nullable|string',
            'is_default' => 'required|in:1,0',
        ];
    }
}
