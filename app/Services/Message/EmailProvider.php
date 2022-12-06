<?php

namespace App\Services\Message;

use App\Models\User;

class EmailProvider implements MessageInterface
{
   /**
    * send otp message
    *
    * @param User $user
    * @param [type] $otp
    * @return void
    */
    public function sendMessage(User $user, $otp)
    {
        // here we will add the way to send mail of this provider
    }
}
