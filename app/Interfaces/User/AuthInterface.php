<?php

namespace App\Interfaces\User;

use Illuminate\Support\Collection;

interface AuthInterface
{
    /**
     * register user function
     *
     * @param [type] $request
     * @param [type]
     * @return void
     */
    public function register(Collection $userData);

    public function updateUser(Collection $userData);
    
    public function login(Collection $userData);
    
    public function ChangePassword(Collection $userData);

    public function softDelete($id);
}
