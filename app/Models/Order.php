<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_number',
        'merchant_id',
        'invoice_id',
        'total_items',
        'note',
        'user_id',
        'payment_method_id'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
}
