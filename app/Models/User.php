<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'deleted_at',
        'email_verified_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * get user id
     *
     * @return int
     */
    public function getId(): int
    {
        return intval($this->id);
    }

    /**
     * get user uuid
     *
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(): self
    {
        $this->uuid = (string) Str::uuid();

        return $this;
    }

    /**
     * get user full name
     *
     * @return string
     */
    public function getFullName(): string
    {
        return $this->full_name;
    }

    /**
     * set user full name
     *
     * @param  string  $full_name
     * @return self
     */
    public function setFullName(string $full_name): self
    {
        $this->full_name = $full_name;

        return $this;
    }

    /**
     * get user phone number
     *
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->mobile;
    }

    /**
     * set user phone number
     *
     * @param  string  $mobile
     * @return self
     */
    public function setPhoneNumber(string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * get user id number
     *
     * @return int
     */
    public function getIdNumber(): int
    {
        return $this->id_number;
    }

    /**
     * set user id number
     *
     * @param  string  $id_number
     * @return self
     */
    public function setIdNumber(string $id_number): self
    {
        $this->id_number = $id_number;

        return $this;
    }

    /**
     * get user email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * set user email
     *
     * @param  string  $email
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = trim($email);

        return $this;
    }

    /**
     * get user password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = Hash::make($password);

        return $this;
    }
    /**
     * get Date of birth
     *
     * @return string
     */
    public function getDOB(): string
    {
        return $this->date_of_birth;
    }

    public function setDOB(string $dob): self
    {
        $this->date_of_birth = $dob;
        return $this;
    }
    /**
     * get user gender
     *
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * set user gender
     *
     * @param string $gender
     * @return self
     */
    public function setGender(string $gender): self
    {
        $this->gender = $gender;
        return $this;
    }
    /**
     * get user country code
     *
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->country_code;
    }

    /**
     * set user country code
     *
     * @param string $country_code
     * @return self
     */
    public function setCountryCode(string $country_code): self
    {
        $this->country_code = $country_code;
        return $this;
    }
    /**
     * get user country code
     *
     * @return string
     */
    public function getCountryID(): string
    {
        return $this->country_id;
    }

    /**
     * set user country code
     *
     * @param string $country_id
     * @return self
     */
    public function setCountryID(string $country_id): self
    {
        $this->country_id = $country_id;
        return $this;
    }

    /**
     * generate user Token
     *
     * @return string
     */
    public function getToken(): string
    {
        return $this->createToken('userToken')->plainTextToken;
    }
    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class, 'user_carts')->withPivot('id', 'quantity', 'product_variant_details');
    }

    public function shop()
    {
        return $this->hasMany(Shop::class);
    }
}
