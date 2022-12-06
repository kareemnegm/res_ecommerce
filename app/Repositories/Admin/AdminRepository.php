<?php

namespace App\Repositories\Admin;

use App\Http\Resources\User\UserResource;
use App\Interfaces\Admin\AdminInterface;
use App\Models\Merchant;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class AdminRepository extends BaseRepository implements AdminInterface
{
    /**
     * register user
     *
     * @param [type] $request
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

    public function createMerchant(Collection $data)
    {
        $user = new User();
        $user->setUuid()
             ->setFullName($data->get('full_name'))
             ->setIdNumber($data->get('id_number'))
             ->setEmail($data->get('email'))
             ->setPassword($data->get('password'))
             ->setCountryCode($data->get('country_code'))
             ->setPhoneNumber($data->get('mobile'))
             ->setCountryID($data->get('country_id'))
             ->save();
        $user->assignRole('merchant');
        return $this->success(201, ['message'=> __('auth.user.created'),'user'=> new UserResource($user)]);
    }
}
