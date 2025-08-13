<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserAccount extends Authenticatable implements JWTSubject
{
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id', 'user_fname', 'user_mname', 'user_lname',
        'user_province', 'user_city', 'user_zip',
        'user_status', 'user_username', 'user_password','userRole'
    ];

    protected $hidden = ['user_password'];

    public function getAuthPassword()
    {
        return $this->user_password;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
