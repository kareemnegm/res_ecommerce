<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'product_variant_id'
    ];

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }




}
