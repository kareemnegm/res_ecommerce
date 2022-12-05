<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;

class ShopSearch extends BaseFormRequest
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
            'search' => 'required|string|min:1',
        ];
    }
}
