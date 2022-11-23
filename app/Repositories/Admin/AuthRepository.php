<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\AuthInterface;
use App\Models\Admin;
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

    public function register($adminData)
    {
        $adminData['password'] = bcrypt($adminData['password']);
        $admin=Admin::create($adminData);
        $token = $admin->createToken('adminToken')->plainTextToken;
        $data['admin']=$admin;
        $data['token']=$token;
        return $data;

    }


}
