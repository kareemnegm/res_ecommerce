<?php

namespace App\Interfaces\User;

interface AuthInterface
{

    /**
     * register user function
     *
     * @param [type] $request
     * @param [type]
     * @return void
     */
    public function register($userData);

    public function updateUser($userData);

    public function softDelete($id);

}
