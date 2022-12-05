<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;
use App\Rules\RemoveProductFavoriteRule;
use Illuminate\Http\Request;

class RemoveFavoriteProductFormRequest extends BaseFormRequest
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
        $request['user_id'] = auth('user')->user()->id;

        return [
            'id' => ['required', 'exists:products,id', new RemoveProductFavoriteRule($request)],
        ];
    }
}
