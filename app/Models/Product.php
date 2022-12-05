<?php

namespace App\Models;

use App\Traits\FileTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Tags\HasTags;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements HasMedia
{
    use HasFactory, HasTags, InteractsWithMedia, FileTrait, HasTranslations, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'offer_price',
        'weight',
        'order',
        'stock_quantity',
        'merchant_category_id',
        'merchant_id',
        'is_published',
    ];

    protected $appends = ['Tags'];

    public $translatable = ['name', 'description'];

    public function merchantCategory()
    {
        return $this->belongsTo(MerchantCategory::class);
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function variant()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function ProductCombination()
    {
        return $this->hasMany(ProductCombination::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(600)
            ->sharpen(0);
    }

    public function getTagsAttribute()
    {
        return $this->tags()->get();
    }

    public function scopeActive($query)
    {
        return $query->where('is_published', 1);
    }
}
