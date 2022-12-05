<?php

namespace App\Repositories\Merchant;

use App\Http\Resources\ShopResource;
use App\Interfaces\Merchant\ShopInterface;
use App\Models\Shop;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class ShopRepository extends BaseRepository implements ShopInterface
{




    /**
     *create shop
     *
     *@param [type] $request
     *
     * @return void
     */

    public function createShop(array $shopData)
    {

        $shop = new Shop();
        $shop
            ->setShopName($shopData['shop_name'])
            ->setDescription($shopData['description'])
            ->setPhoneNumber($shopData['mobile'])
            ->setCountryId($shopData['country_id'])
            ->setUserId($shopData['user_id'])
            ->save();
        if (isset($shopData['shop_logo'])) {
            $shop->saveFiles($shopData['shop_logo'], 'shop_logo');
        }
        $shop->category()->sync($shopData['category_id']);
        return $this->success(201, ['message' => __('shop.shop.created'), 'shop' => new ShopResource($shop)]);
    }


    /**
     *update shop
     *
     *@param [type] $request
     *
     * @return void
     */

    public function updateShop(array $shopData)
    {

        $shop = Shop::find($shopData['id']);
        $shop
            ->setShopName($shopData['shop_name'])
            ->setDescription($shopData['description'])
            ->setPhoneNumber($shopData['mobile'])
            ->setCountryId($shopData['country_id'])
            ->save();
        if (isset($shopData['shop_logo'])) {

            if ($shop->getMedia('shop_logo')) {

                $shop->clearMediaCollectionExcept('shop_logo');
            }

            $shop->saveFiles($shopData['shop_logo'], 'shop_logo');
        }
        $shop->category()->sync($shopData['category_id']);
        return $this->success(200, ['message' => __('shop.shop.updated'), 'shop' => new ShopResource($shop)]);
    }


    /**
     * create shop payment methods
     *
     * @param [type] $request
     *
     * @return void
     */

    public function assignShopPaymentMethod($paymentMethodData)
    {

        $shop = Shop::find($paymentMethodData['shop_id']);


        $shop->shopPaymentMethods()->syncWithoutDetaching($paymentMethodData['payment_method_id']);
        return $this->success(200, ['message' => __('shop.payment_method.added')]);
    }



    /**
     * create shop payment methods
     *
     * @param [type] $request
     *
     * @return void
     */

    public function retrievePaymentMethods($shopId)
    {
        $shop = Shop::find($shopId);

        
        return $shop->shopPaymentMethods;

    }
}
