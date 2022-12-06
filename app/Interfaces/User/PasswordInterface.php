<?php

namespace App\Interfaces\User;

use Illuminate\Support\Collection;

interface PasswordInterface
{

    public function forgetPassword(Collection $request);

    public function verifyCode(Collection $request);

    public function resetPassword(Collection $request);

}
