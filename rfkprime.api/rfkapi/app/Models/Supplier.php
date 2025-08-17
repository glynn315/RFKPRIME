<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier_information';

     protected $primaryKey = 'supplier_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'supplier_id',
        'supplier_name',
        'brand_name',
        'supplier_status',
    ];
}
