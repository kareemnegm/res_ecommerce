<?php

namespace App\Models;

use App\Traits\FileTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Shop extends Model implements HasMedia
{
    use HasFactory, SoftDeletes , FileTrait ,InteractsWithMedia  ;
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
     * get user shop name
     *
     * @return string
     */
    public function getShopName(): string
    {
        return $this->shop_name;
    }

    /**
     * set user shop name
     *
     * @param  string  $shop_name
     * @return self
     */
    public function setShopName(string $shop_name): self
    {
        $this->shop_name = $shop_name;

        return $this;
    }
    /**
     * get shop description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * set  description
     *
     * @param  string  $description
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

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
     * get user country id
     *
     * @return int
     */
    public function getCountryId(): int
    {
        return $this->country_id;
    }

    /**
     * set  user country id
     *
     * @param  string  $country_id
     * @return self
     */
    public function setCountryId(string $country_id): self
    {
        $this->country_id = $country_id;

        return $this;
    }

    /**
     * get user id number
     *
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * set user id number
     *
     * @param  string  $user_id
     * @return self
     */
    public function setUserId(string $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * get approved
     *
     * @return int
     */
    public function getApproved(): int
    {
        return $this->approved;
    }

    /**
     * set user id number
     *
     * @param  string  $approved
     * @return self
     */
    public function setApproved(string $approved): self
    {
        $this->approved = $approved;

        return $this;
    }







    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }



    public function shopCategory()
    {
        return $this->hasMany(ShopCategory::class);
    }


    public function shopPaymentMethods()
    {
        return $this->belongsToMany(PaymentMethod::class, 'shop_payment_methods');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(600)
            ->sharpen(0);
    }



    public function scopeApproved($query)
    {
        return $query->where('approved', 1);
    }
}
