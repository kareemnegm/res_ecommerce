<?php

namespace App\Models;

use App\Traits\FileTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class PaymentMethod extends Model implements HasMedia

{
    use HasFactory, HasTranslations, InteractsWithMedia, FileTrait;
    protected $fillable = [
        'name',
        'status',
    ];

    public $translatable = ['name'];

    public function CreditCard()
    {
        // return $this->hasMany();
    }

    public function merchants()
    {
        return $this->belongsToMany(Merchant::class,'merchant_payment_methods');
    }

    public function ScopeActive($query){
        return $query->where('status', 1);

    }


    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(600)
            ->sharpen(0);
    }
}
