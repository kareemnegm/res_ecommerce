<?php

namespace App\Interfaces\User;

interface ShopInterface
{
    public function shops();

    public function shopsByCategories($categoryId);

    public function shopProducts($shopId);

    public function showShop($shopId);

    public function searchShop($request);

    public function shopCategories($id);
    public function searchProductInShop($search,$id);

}
