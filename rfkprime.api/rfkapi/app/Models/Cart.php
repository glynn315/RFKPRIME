<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'product_price',
        'cart_status',
        'product_id',
        'cart_id',
        'discount',
        'vat',
    ];
}
