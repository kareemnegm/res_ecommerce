<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_combination_id',
        'price',
        'stock',
    ];

    public function ProductCombination()
    {
        return $this->belongsTo(ProductCombination::class);
    }
}
