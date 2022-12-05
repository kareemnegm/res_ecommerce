<?php

namespace App\Repositories\Merchant;

use App\Http\Resources\Merchant\MerchantCategoryResource;
use App\Interfaces\Merchant\MerchantCategoryInterface;
use App\Models\MerchantCategory;
use App\Models\ShopCategory;
use App\Repositories\BaseRepository;

class MerchantCategoryRepository extends BaseRepository implements MerchantCategoryInterface
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
        $category = new ShopCategory();
        $category
            ->setName($categoryData['name'])
            ->setShopId($categoryData['shop_id'])
            ->setShopCategoryId($categoryData['shop_category_id'])
            ->save();
        return $this->success(201, ['message' => __('shop.category.created'), 'shop_category' => new MerchantCategoryResource($category)]);

    }

    public function index($request)
    {
        $categories = MerchantCategory::where('merchant_id', $request['merchant_id'])->whereNull('merchant_category_id')->orderBy('id', 'desc')->get();
        return $categories;
    }


    public function update(array $categoryData)
    {
        $category = ShopCategory::findOrFail($categoryData['shop_id']);
        $category
            ->setName($categoryData['name'])
            ->setShopCategoryId($categoryData['shop_category_id'])
            ->save();
        return $this->success(200, ['message' => __('shop.category.updated'), 'shop_category' => new MerchantCategoryResource($category)]);

    }


    public function delete($id, $auth)
    {
        $category = MerchantCategory::where('id', $id)->where('merchant_id', $auth)->firstOrFail();
        $category->delete();
    }


    public function show(array $shopCategoryData)
    {
        $category= ShopCategory::where('id', $shopCategoryData['shop_category_id'])->where('shop_id', $shopCategoryData['shop_id'])->firstOrFail();
        return $this->success(200, ['message' => __('shop.category.retrieved'), 'shop_category' => new MerchantCategoryResource($category)]);

    }
}
