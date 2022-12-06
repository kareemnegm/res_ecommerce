<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductSearchFormRequest extends BaseFormRequest
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
            'id' => 'required|exists:shops,id',
            'search' => 'required|string|min:1',
            'filter' => 'in:name,price,order',
            'sortBy' => 'in:desc,asc',
            'page' => 'nullable|integer',
            'limit' => 'nullable|integer',
        ];
    }
    public function messages()
    {
        return[
            'id.exists'=>'shop ID is not valid '
        ];
    }
}
