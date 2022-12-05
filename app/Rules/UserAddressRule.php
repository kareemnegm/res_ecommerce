<?php

namespace App\Rules;

use App\Models\UserAddress;
use Illuminate\Contracts\Validation\Rule;

class UserAddressRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        $userId = auth('user')->user()->id;
        $Address = UserAddress::where('id', $value)->where('user_id', $userId)->first();

        if ($Address) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Address ID Not Related With User.';
    }
}
