<?php

namespace App\Interfaces\Merchant;

interface MerchantCategoryInterface
{


    public function create($categoryData);
    public function index($request);
    public function update(array $categoryData);
    public function delete($id,$auth);
    public function show(array $shopCategoryData);
}
