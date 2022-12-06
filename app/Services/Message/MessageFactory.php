<?php

namespace App\Services\Message;

use App\Models\OtpCode;
use App\Models\User;
use Carbon\Carbon;

class MessageFactory
{
    public function __construct(private User $user, private MessageInterface $provider, private $otp='')
    {
        $this->otp = $this->generateOTP();
    }

    public function getOtp()
    {
        return $this->otp;
    }

    /**
     * send otp sms from desired provider
     *
     * @param  SMSInterface  $provider
     * @return void
     */
    public function sendMessage()
    {
        $this->provider->sendMessage($this->user, $this->otp);
    }

    /**
     * generat otp for phone number and store it in otpcode
     *
     * @return void
     */
    public function generateOTP()
    {
        $code = OtpCode::where('user_uuid', $this->user->getUuid())->first();

        if ($code) {
            if (! $code->expired()) {
                return $code->getOtp();
            }

            return $this->setCode($code, Carbon::now());
        } else {
            $code = new OtpCode();

            return $this->setCode($code, Carbon::now());
        }
    }

    /**
     * Sets New OTP Code
     *
     * @param  OtpCode  $code
     * @param  Carbon  $now
     * @return int
     */
    public function setCode(OtpCode $code, Carbon $now): int
    {
        $otp = random_int(1000, 9999);
        $code->setExpire($now->addMinute())
        ->setOtp($otp)
        ->setUserUuid($this->user->getUuid())
        ->setUnverified()
        ->save();

        return $otp;
    }
}
