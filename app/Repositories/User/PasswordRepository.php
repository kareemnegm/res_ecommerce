<?php

namespace App\Repositories\User;

use App\Http\Resources\User\UserResource;
use App\Interfaces\User\PasswordInterface;
use App\Models\OtpCode;
use App\Models\User;
use App\Repositories\BaseRepository;
use App\Services\Message\EmailProvider;
use App\Services\Message\SMSProvider;
use App\Services\Message\MessageFactory;
use Illuminate\Support\Collection;
class PasswordRepository extends BaseRepository implements PasswordInterface
{
    /**
     * send verify code to user 
     *
     * @param Collection $request
     * @return array
     */
    public function forgetPassword(Collection $request): array
    {
        $user = User::where(function ($query) use ($request) {
                $query->where('mobile', $request->get('phone_number'))
                    ->orWhere('email', $request->get('email'));
                })->first();
        if (! $user) 
            return $this->failed(400, ['error' => __('auth.not_found')], 1061, 'User Not Found');

        $otp = $this->sendMessage($user, $request);
       

        return $this->success(200, ['otp' => $otp, 'message' => __('auth.otp.sent')]);
    }

    /**
     * verifiying user code 
     *
     * @param Collection $request
     * @return array
     */
    public function verifyCode(Collection $request): array
    {
        $user = User::where(function ($query) use ($request) {
                        $query->where('mobile', $request->get('phone_number'))
                            ->orWhere('email', $request->get('email'));
                    })->first();
        if (! $user) 
            return $this->failed(400, ['error' => __('auth.not_found')], 1061, 'User Not Found');     

       $code = OtpCode::NotVerified()
            ->where('user_uuid', $user->getUuid())
            ->where('otp', $request->get('code'))
            ->first();

        if (! $code) {
            return $this->failed(400, ['error' => __('auth.otp.invalid')], 1075, 'Invalid OTP');
        }

        if ($code->expired()) {
            $otp = $this->sendMessage($user, $request);
            return $this->failed(400, ['error' => __('auth.otp.expired'), 'otp' => $otp], 1076, 'OTP Expired');
        }

        $code->setVerified()->save();

        return $this->success(200, ['message' => __('auth.otp.valid')]);
    }
    /**
     * reset user password
     *
     * @param Collection $request
     * @return array
     */
    public function resetPassword(Collection $request): array
    {
        $user = User::where(function ($query) use ($request) {
            $query->where('mobile', $request->get('phone_number'))
                ->orWhere('email', $request->get('email'));
        })->first();

        if (! $user) 
            return $this->failed(400, ['error' => __('auth.not_found')], 1061, 'User Not Found');     
        
        $otp = OtpCode::where('user_uuid', $user->getUuid())->verified()->first();
        if (! $otp)
            return $this->failed(400, ['error' => __('auth.otp.not_verified')]);
        
        $user->setPassword($request->get('password'))
        ->save();
        $otp->setUnverified()->save();
        
        return $this->success(200, ['message' => __('auth.password_reset'), 'token' => $user->getToken(), 'user' => new UserResource($user)]);

    }

    public function sendMessage(User $user, Collection $request)
    {
        if($request->get('email'))
        $messageFactory = new MessageFactory($user , new EmailProvider());
        else if($request->get('phone_number'))
            $messageFactory = new MessageFactory($user , new SMSProvider());

        $messageFactory->sendMessage();
        return $messageFactory->getOtp();
    }
}