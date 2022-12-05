<?php

namespace App\Interfaces\User;

interface UserInterface
{
    public function createAddress(array $data);

    public function updateAddress(array $data);

    public function myAddresses($userId);

    public function addProductsToCart(array $data);

    public function addProductToFavorite(array $data);

    public function removeProductFromFavorite(array $data);

    public function removeProductFromCart(array $data);
}
