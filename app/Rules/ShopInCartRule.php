<?php

namespace App\Rules;

use App\Models\UserCart;
use Illuminate\Contracts\Validation\Rule;

class ShopInCartRule implements Rule
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

        $user = UserCart::where('user_id', $this->request->user_id)->exists();
        if ($user) {
            $merchant = UserCart::where('user_id', $this->request->user_id)->where('merchant_id', $this->request->merchant_id)->exists();
            if ($merchant) {
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
        return 'You  Cant Add Product From Another Shop';
    }
}
