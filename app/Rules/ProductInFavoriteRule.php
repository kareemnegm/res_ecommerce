<?php

namespace App\Rules;

use App\Models\Favorite;
use Illuminate\Contracts\Validation\Rule;

class ProductInFavoriteRule implements Rule
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

        $favorite = Favorite::where('user_id', $this->request->user_id)->exists();
        if ($favorite) {
            $product = Favorite::where('user_id', $this->request->user_id)->where('product_id', $this->request->product_id)->exists();

            if ($product) {
                return false;
            } else {
                return true;
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
        return 'Product already exists in your favorites';
    }
}
