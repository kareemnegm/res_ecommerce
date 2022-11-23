<?php

namespace App\Repositories\Merchant;

use App\Interfaces\Merchant\MerchantCategoryInterface;
use App\Models\MerchantCategory;

class MerchantCategoryRepository implements MerchantCategoryInterface
{
    /**
     * register user
     *
     * @param [type] $request
     *
     * @return void
     */

    public function create($categoryData)
    {
        MerchantCategory::create($categoryData);
    }

    public function index($request)
    {
        $categories = MerchantCategory::where('merchant_id', $request['merchant_id'])->whereNull('merchant_category_id')->orderBy('id', 'desc')->get();
        return $categories;
    }
    public function update($categoryData, $id)
    {
        $category = MerchantCategory::where('id', $id)->where('merchant_id', $categoryData['merchant_id'])->firstOrFail();
        $category->update($categoryData);
    }


    public function delete($id, $auth)
    {
        $category = MerchantCategory::where('id', $id)->where('merchant_id', $auth)->firstOrFail();
        $category->delete();
    }


    public function show($id, $auth)
    {
        return MerchantCategory::where('id', $id)->where('merchant_id', $auth)->firstOrFail();
    }
}
