<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseFormRequest extends FormRequest
{


    /**
     * 
     */
    protected function prepareForValidation()
    {
        $this->merge(['id' => $this->route('id')]);
    }
      /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status_code' => 422,
            'code' => 1422,
            'hint' => 'Unprocessable Entity',
            'errors' => $validator->errors(),
            'success' => false, ], 422));
    }


}
