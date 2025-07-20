<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'supplier_id',
        'product_name',
        'product_volume',
        'product_quantity',
        'product_pricepc',
        'product_pricebulk',
        'product_status',
    ];
}
