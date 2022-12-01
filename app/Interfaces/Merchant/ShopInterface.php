<?php

namespace App\Interfaces\Merchant;

interface ShopInterface
{

    /**
     * choose shop payment methods function
     *
     * @param [type] $request
     * @param [type]
     * @return void
     */

    public function assignShopPaymentMethod($paymentMethodData);


/**
     * return shop payment methods function
     *
     * @param [type] merchant
     * @param [type]
     * @return void
     */
    public function retrievePaymentMethods($merchant);

}
