<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable=[
        'order_id',
        'customer_id',
        'payment_method',
        'terms',
        'percentage',
        'cart_id',
    ];
}
