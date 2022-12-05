<?php

namespace App\Repositories\Merchant;

use App\Interfaces\Merchant\AuthInterface;
use App\Models\Merchant;

class AuthRepository implements AuthInterface
{
    public function update($merchantData)
    {
        $merchant = Merchant::findOrFail($merchantData['id']);
        if (isset($merchantData['shop_logo'])) {

            if ($merchant->getMedia('shop_logo')) {

                $merchant->clearMediaCollectionExcept('shop_logo');
            }

            $merchant->saveFiles($merchantData['shop_logo'], 'shop_logo');
        }

        $merchant->update($merchantData);
        $merchant->category()->sync($merchantData['category_id']);
    }



    public function myProfile($id)
    {
        return Merchant::findOrFail($id);
    }
}
