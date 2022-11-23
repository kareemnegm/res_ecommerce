<?php

namespace App\Repositories\user;

use App\Interfaces\User\AuthInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthInterface
{
    /**
     * register user
     *
     * @param [type] $request
     *
     * @return void
     */

    public function register($userData)
    {
        $userData['password'] = bcrypt($userData['password']);
        $user=User::create($userData);
        $token = $user->createToken('userToken')->plainTextToken;
        $data['user']=$user;
        $data['token']=$token;
        return $data;

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
        User::where('id', $userData['id'])->update($userData);
    }

    /**
     * soft delete user
     *
     * @param [type] $request
     *
     * @return void
     */
    public function softDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}
