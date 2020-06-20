<?php

namespace App\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    protected $connection = 'mongodb';

    use Notifiable;
    use SoftDeletes;

    public function __construct(array $attributes = [])
    {
        $this->attributes['role'] = 'normal';
        $this->attributes['is_api'] = false;
        parent::__construct($attributes);
    }

    protected $attributes = ['role' => 'normal', 'is_api' => false];

    protected $fillable = [
        'name', 'email', 'password', 'facebook_id', 'access_token', 'page_use', 'page_selected', 'role', 'social_id',
        'avatar', 'deleted_at', 'page_use_api', 'key', 'secret', 'is_api', 'arr_api_url'
    ];

    protected $hidden = [
        'password', 'remember_token', 'access_token', 'key', 'secret', 'is_api', 'arr_api_url'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    protected $dates = ['deleted_at'];

    public function getPageUse()
    {
        if ($this->getAttribute('page_use')) {
            return json_decode($this->getAttribute('page_use'), true);
        }
        return [];
    }

    public function getPageUseAPI()
    {
        if ($this->getAttribute('page_use_api')) {
            return json_decode($this->getAttribute('page_use'), true);
        }
        return [];
    }

    public function getPageSelected()
    {
        $page = new Page();
        $arr_page_use = $this->getPageUse();
        $page_selected = $this->getAttribute('page_selected');
        if ($page_selected) {
            if (in_array($page_selected, $arr_page_use) && in_array($page_selected, $page->listFbPageId())) {
                return $page_selected;
            }
        }
        return '';
    }

    public function getRole()
    {
        return $this->getAttribute('role');
    }

    public function listPage()
    {
        if (Auth::check())
            return UserRolePage::whereuser_child(Auth::id())->wherestatus(1)->wheretype(1)->pluck('fb_page_id')->toArray();
        return [];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
        // TODO: Implement getJWTIdentifier() method.
    }

    public function getJWTCustomClaims()
    {
        return array();
        // TODO: Implement getJWTCustomClaims() method.
    }
}
