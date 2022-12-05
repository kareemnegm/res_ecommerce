<?php

namespace App\Interfaces\Merchant;

interface MerchantCategoryInterface
{
    public function create($categoryData);

    public function index($request);

    public function update($categoryData, $id);

    public function delete($id, $auth);

    public function show($id, $auth);
}
