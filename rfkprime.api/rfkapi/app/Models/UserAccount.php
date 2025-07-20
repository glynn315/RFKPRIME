<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class UserAccount extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'user_id',
        'user_fname',
        'user_mname',
        'user_lname',
        'user_province',
        'user_city',
        'user_zip',
        'user_status',
        'user_username',
        'user_password',
    ];

    protected $hidden = [
        'user_password',
    ];

    protected function casts(): array
    {
        return [
            'user_password' => 'hashed',
        ];
    }
}
