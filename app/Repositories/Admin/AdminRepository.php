<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\AdminInterface;
use App\Models\Merchant;

class AdminRepository implements AdminInterface
{
    /**
     * register user
     *
     * @param [type] $request
     *
     * @return void
     */

    public function merchantsList($request)
    {
        if (isset($request['approved'])) {
            $approved = $request['approved'] == 'true' ? 1 : 0;
            return Merchant::where('approved', $approved)->get();
        }
        return Merchant::all();
    }


    public function approveMerchant($id)
    {
        $merchant = Merchant::findOrFail($id);
        $merchant->update(['approved' => 1]);
    }

    public function createMerchant(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        $merchant = Merchant::create($data);
        if (isset($data['shop_logo'])) {
            $merchant->saveFiles($data['shop_logo'], 'shop_logo');
        }
        $merchant->category()->sync($data['category_id']);
        return $merchant;
    }
}
