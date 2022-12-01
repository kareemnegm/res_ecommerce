<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class UserCart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'merchant_id',
        'quantity',
        'product_variant_details'
    ];
    protected $casts = ['product_variant_details' => 'array'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

  

}
