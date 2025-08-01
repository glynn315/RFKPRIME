<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terms extends Model
{
    use HasFactory;

    protected $fillable =[
        'amount',
        'schedule_date',
        'payment_date',
        'payment_status',
        'payment_id',
    ];
}
