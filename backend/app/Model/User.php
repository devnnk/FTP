<?php

namespace App\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
// use Illuminate\Foundation\Auth\User as Authenticatable

use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $connection = 'mongodb';

    protected $collection = 'users';

    // use Notifiable;
    use SoftDeletes;

    public function __construct(array $attributes = [])
    {
        $this->attributes['role'] = 'normal';
        parent::__construct($attributes);
    }

    protected $attributes = ['role' => 'normal'];

    protected $fillable = [
        'name', 'email', 'password', 'role','provider', 'provider_id','access_token'
    ];

    protected $hidden = [
        'password','remember_token'
    ];

    protected $dates = ['deleted_at'];

}
