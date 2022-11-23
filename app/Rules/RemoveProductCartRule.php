<?php

namespace App\Rules;

use App\Models\UserCart;
use Illuminate\Contracts\Validation\Rule;

class RemoveProductCartRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $favorite = UserCart::where('user_id', $this->request->user_id)->exists();
        if ($favorite) {
            $product = UserCart::where('user_id', $this->request->user_id)->where('product_id', $this->request->id)->exists();

            if ($product) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Product not exists in your cart';
    }
}
