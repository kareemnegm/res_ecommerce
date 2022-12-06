<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpCode extends Model
{
    use HasFactory;

    /**
     * get otp code
     *
     * @return string
     */
    public function getOtp(): string
    {
        return $this->otp;
    }

    /**
     * set otp code
     *
     * @param  string  $otp
     * @return self
     */
    public function setOtp(string $otp): self
    {
        $this->otp = $otp;

        return $this;
    }

    /**
     * get expired time
     *
     * @return string
     */
    public function getExpire(): string
    {
        return $this->expire_at;
    }

    /**
     * set Expire time
     *
     * @param  string  $expire_at
     * @return self
     */
    public function setExpire(string $expire_at): self
    {
        $this->expire_at = $expire_at;

        return $this;
    }

    /**
     * get user uuid
     *
     * @return string
     */
    public function getUserUuid(): string
    {
        return $this->user_uuid;
    }

    /**
     * set user uuid
     *
     * @param  string  $user_uuid
     * @return self
     */
    public function setUserUuid(string $user_uuid): self
    {
        $this->user_uuid = $user_uuid;

        return $this;
    }

    /**
     * get user is verified
     *
     * @return bool
     */
    public function getVerified(): bool
    {
        return $this->is_verified;
    }

    /**
     * set is verified to true
     *
     * @return self
     */
    public function setVerified(): self
    {
        $this->is_verified = true;

        return $this;
    }

    /**
     * Checks if otp is expired
     *
     * @return bool
     */
    public function expired(): bool
    {
        return $this->expire_at < Carbon::now();
    }

    /**
     * Set is_verified to false
     */
    public function setUnverified(): self
    {
        $this->is_verified = false;

        return $this;
    }

    /**
     * Return only verified phone numbers
     *
     * @param    $query
     * @return  $query
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', 1);
    }

    /**
     * Return only not verified phone numbers
     *
     * @param    $query
     * @return  $query
     */
    public function scopeNotVerified($query)
    {
        return $query->where('is_verified', 0);
    }
}
