<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'street',
        'nearest_landmark',
        'mobile',
        'latitude',
        'longitude',
        'notes',
        'is_default',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
