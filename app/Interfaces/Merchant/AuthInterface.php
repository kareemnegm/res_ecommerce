<?php

namespace App\Interfaces\Merchant;

interface AuthInterface
{

    /**
     * register merchant function
     *
     * @param [type] $request
     * @param [type]
     * @return void
     */
    public function register($MerchantData);

     /**
     * update merchant function
     *
     * @param [type] $request
     * @param [type]
     * @return void
     */
    public function update($merchantData);


     /**
     * merchant profile using auth
     *
     * @return void
     */
    public function myProfile($id);


}
