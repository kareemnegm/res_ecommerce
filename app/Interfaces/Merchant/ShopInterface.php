<?php

namespace App\Interfaces\Merchant;

use Illuminate\Support\Collection;

interface ShopInterface
{

    /**
     * create shop  function
     *
     * @param [type] $request
     * @param [type]
     * @return void
     */

    public function createShop(array $shopData);

    /**
     * update shop  function
     *
     * @param [type] $request
     * @param [type]
     * @return void
     */

    public function updateShop(array $shopData);


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






    /****************************************************
     * user
     */


    public function shops();
    public function shopsByCategories($categoryId);
    public function shopProducts($shopId);
    public function showShop($shopId);
    public function searchShop($request);
    public function shopCategories($id);
    public function searchProductInShop($search,$id);

}
