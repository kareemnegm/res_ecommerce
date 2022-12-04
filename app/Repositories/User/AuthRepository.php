<?php

namespace App\Repositories\user;

use App\Http\Resources\User\UserResource;
use App\Interfaces\User\AuthInterface;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class AuthRepository extends BaseRepository implements AuthInterface
{
    /**
     * register user
     *
     * @param [type] $request
     *
     * @return void
     */

    public function register(Collection $userData): array
    {
        $user = new User();
        $user->setUuid()
             ->setFullName($userData->get('full_name'))
             ->setIdNumber($userData->get('id_number'))
             ->setEmail($userData->get('email'))
             ->setPassword($userData->get('password'))
             ->setDOB($userData->get('date_of_birth'))
             ->setGender($userData->get('gender'))
             ->setCountryCode($userData->get('country_code'))
             ->setPhoneNumber($userData->get('mobile'))
             ->setCountryID($userData->get('country_id'))
             ->save();
        $user->assignRole('customer');
        return $this->success(201, ['message'=> __('auth.user.created'),'user'=> new UserResource($user), 'token' => $user->getToken()]);
    }

    /**
     * update user
     *
     * @param [type] $request
     *
     * @return void
     */
    public function updateUser($userData)
    {
        $user = User::find($userData->get('id'));
        $user->setFullName($userData->get('full_name'))
            ->setIdNumber($userData->get('id_number'))
            ->setEmail($userData->get('email'))
            ->setDOB($userData->get('date_of_birth'))
            ->setGender($userData->get('gender'))
            ->setCountryCode($userData->get('country_code'))
            ->setPhoneNumber($userData->get('mobile'))
            ->setCountryID($userData->get('country_id'))
            ->save();

        return $this->success(200, ['message'=> __('auth.user.updated'), 'user' => new UserResource($user)]);
    }

    /**
     * soft delete user
     *
     * @param [type] $request
     *
     * @return void
     */
    public function softDelete($id): array
    {
        $user = User::findOrFail($id);
        $user->delete();
        
        return $this->success(200, ['message'=> __('auth.user.deleted')]);

    }

    public function login(Collection $request): array
    {
        $user = User::where('email', $request->get('email'))->first();
        if (!$user || !Hash::check($request->get('password'), $user->getPassword())) {

            return $this->failed(400, ['error' => __('auth.failed')], 1060, 'Wrong Password');
        }

        return $this->success(200, ['message' => __('auth.success'), 'token' => $user->getToken()]);
    }

    public function ChangePassword(Collection $userData): array
    {
        $user = auth()->user();
        if (!Hash::check($userData->get('current_password'), $user->password)) {
            return $this->failed(400, ['error' => __('auth.current_password')], 1060, 'Wrong Password');
        }
        $user->setPassword($userData->get('password'))
             ->save();
        return $this->success(200, ['message'=> __('auth.password_changed'), 'token'=> $user->getToken()]);
    }
}
