<?php

namespace App\Repositories\Merchant;

use App\Interfaces\Merchant\AuthInterface;
use App\Models\Merchant;

class AuthRepository implements AuthInterface
{
    /**
     * register user
     *
     * @param [type] $request
     * @return void
     */
    public function register($merchantData)
    {
        $merchantData['password'] = bcrypt($merchantData['password']);
        $merchant = Merchant::create($merchantData);
        if (isset($merchantData['shop_logo'])) {
            $merchant->saveFiles($merchantData['shop_logo'], 'shop_logo');
        }
        $merchant->category()->sync($merchantData['category_id']);
    }

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
