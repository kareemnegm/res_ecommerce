<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'discount',
        'shipment_fees',
        'total_product_price',
        'total_invoice',
        'invoice_date',
        'taxes',
        'user_id'
    ];
}
