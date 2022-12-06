<?php

namespace App\Services\Message;

use App\Models\User;

interface MessageInterface
{
    public function sendMessage(User $user, $otp);
}
