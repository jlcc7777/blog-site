<?php

namespace blog;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPassword($value){
        $this->attributes['password'] = bcrypt($value);
    }

    public function getCurrentUser($value){
        return strtok($value, '@');
    }

    function socialProviders()
    {
        return $this->hasMany(SocialProvider::class);
    }

}
