<?php

namespace App\Repositories\user;

use App\Interfaces\User\UserInterface;
use App\Models\Favorite;
use App\Models\UserAddress;
use App\Models\UserCart;

class UserRepository implements UserInterface
{
    public function createAddress(array $data)
    {
        return UserAddress::create($data);
    }

    public function updateAddress(array $data)
    {
        UserAddress::where('id', $data['id'])->update($data);
    }

    public function myAddresses($userId)
    {
        return UserAddress::where('user_id', $userId)->get();
    }

    public function addProductsToCart(array $data)
    {
        $productInCart = UserCart::where('user_id', $data['user_id'])->where('product_id', $data['product_id'])->where('merchant_id', $data['merchant_id'])->first();
        $quantity = isset($productInCart) ? $productInCart->quantity + $data['quantity'] : $data['quantity'];
        if (isset($productInCart)) {
            $productInCart->update(['quantity' => $quantity]);
        } else {
            UserCart::create([
                'user_id' => $data['user_id'],
                'product_id' => $data['product_id'],
                'merchant_id' => $data['merchant_id'],
                'quantity' => $quantity,
            ]);
        }
    }

    public function removeProductFromCart(array $data)
    {
        $userCart = UserCart::where('user_id', $data['user_id'])->where('product_id', $data['product_id'])->firstOrFail();
        $userCart->delete();
    }

    public function addProductToFavorite(array $data)
    {
        Favorite::create($data);
    }

    public function removeProductFromFavorite(array $data)
    {
        $favorite = Favorite::where('user_id', $data['user_id'])->where('product_id', $data['product_id'])->firstOrFail();
        $favorite->delete();
    }
}
