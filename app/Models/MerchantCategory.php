<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MerchantCategory extends Model
{
    use HasFactory, HasTranslations;
    protected $fillable = [
        'name',
        'merchant_category_id',
        'merchant_id'
    ];

    public $translatable = ['name'];

    public function parent()
    {
        return $this->belongsTo(static::class, 'merchant_category_id');
    }
    public function children()
    {
        return $this->hasMany(static::class, 'merchant_category_id');
    }
    public function subs()
    {
        return $this->children()->with(['subs']);
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function scopeParentOnly($query){
        return $query->where('merchant_category_id', null);
    }
}
