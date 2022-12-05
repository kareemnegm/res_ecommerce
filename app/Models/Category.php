<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'category_id',
    ];

    public $translatable = ['name'];

    public function parent()
    {
        return $this->belongsTo(static::class, 'category_id');
    }

    public function children()
    {
        return $this->hasMany(static::class, 'category_id');
    }

    public function subs()
    {
        return $this->children()->with(['subs']);
    }

    public function merchant()
    {
        return $this->belongsToMany(Merchant::class);
    }
}
