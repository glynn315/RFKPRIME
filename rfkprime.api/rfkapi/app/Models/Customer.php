<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'customer_fname',
        'customer_mname',
        'customer_lname',
        'contact_person',
        'contact_number',
        'customer_province',
        'customer_city',
        'customer_zip',
        'customer_status',
    ];

    public function orders()
    {
        return $this->hasMany(Orders::class, 'customer_id', 'id');
    }
}
