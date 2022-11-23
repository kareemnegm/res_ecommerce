<?php

namespace App\Repositories\user;

use App\Http\Requests\User\CategoryIdRequest;
use App\Interfaces\User\ShopInterface;
use App\Models\Category;
use App\Models\Merchant;
use App\Models\Product;

class ShopRepository implements ShopInterface
{

    public function shops()
    {
        return Merchant::approved()->get();
    }



    public function shopsByCategories($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        return $category->merchant;
    }



    public function shopProducts($shopId)
    {
        return Product::where('merchant_id', $shopId)->active()->get();
    }

    public function showShop($shopId)
    {
        return Merchant::where('id', $shopId)->approved()->firstOrFail();
    }

    public function searchShop($request)
    {
        $merchants = Merchant::orderBy('shop_name', 'Desc')->where('shop_name', 'like', '%' . $request['search'] . '%')->approved()->get();
        return $merchants;
    }


    public function shopCategories($id){
        $shop=Merchant::where('id',$id)->approved()->firstOrFail();
        return $shop->merchantCategory()->parentOnly()->get();
    }
}
