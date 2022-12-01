<?php

namespace App\Repositories\Merchant;

use App\Interfaces\Merchant\ShopInterface;

class ShopRepository implements ShopInterface
{
    /**
     * create shop payment methods
     *
     * @param [type] $request
     *
     * @return void
     */

    public function assignShopPaymentMethod($paymentMethodData)
    {
        $paymentMethodData['merchant']->merchantPaymentMethods()->syncWithoutDetaching($paymentMethodData['payment_method_id']);
    }



    /**
     * create shop payment methods
     *
     * @param [type] $request
     *
     * @return void
     */

    public function retrievePaymentMethods($merchant)
    {
       return $merchant->merchantPaymentMethods;
    }
}
