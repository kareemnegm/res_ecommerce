<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCombination extends Model
{
    use HasFactory;

    protected $fillable = [
        'combination_string',
        'sku',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productStock()
    {
        return $this->hasOne(productStock::class);
    }
}
