<?php

namespace App\Interfaces\Admin;

interface AuthInterface
{
    /**
     * register admin function
     *
     * @param [type] $request
     * @param [type]
     * @return void
     */
    public function register($adminData);
}
