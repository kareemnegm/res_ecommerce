<?php

namespace App\Services\Message;

use App\Models\User;

class SMSProvider implements MessageInterface
{
   
    public function sendMessage(User $user, $otp)
    {
        // here we will add the way to send sms of this provider
    }
}
