<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\UserCart;

class UserCartObserver
{
    /**
     * Handle the UserCart "created" event.
     *
     * @param  \App\Models\UserCart  $userCart
     * @return void
     */
    public function created(UserCart $userCart)
    {
        $product = Product::findOrFail($userCart->product_id);
        $product->stock_quantity = $product->stock_quantity - $userCart->quantity;
        $product->save();
    }

    /**
     * Handle the UserCart "updated" event.
     *
     * @param  \App\Models\UserCart  $userCart
     * @return void
     */
    public function updated(UserCart $userCart)
    {
        //
    }

    /**
     * Handle the UserCart "deleted" event.
     *
     * @param  \App\Models\UserCart  $userCart
     * @return void
     */
    public function deleting(UserCart $userCart)
    {
        $product = Product::findOrFail($userCart['product_id']);
        $product->stock_quantity = $product->stock_quantity + $userCart->quantity;
        $product->save();
    }

    /**
     * Handle the UserCart "restored" event.
     *
     * @param  \App\Models\UserCart  $userCart
     * @return void
     */
    public function restored(UserCart $userCart)
    {
        //
    }

    /**
     * Handle the UserCart "force deleted" event.
     *
     * @param  \App\Models\UserCart  $userCart
     * @return void
     */
    public function forceDeleted(UserCart $userCart)
    {
        //
    }
}
