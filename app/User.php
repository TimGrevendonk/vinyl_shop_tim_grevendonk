<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

/**The attributes that are mass assignable.@var array */
    protected $fillable = [ // these fields are fillable data
        'name', 'email', 'password',
    ];

/**The attributes that are mass assignable.@var array */
    protected $hidden = [ // these fields cannot be asked
        'password', 'remember_token',
    ];

/**The attributes that are mass assignable.@var array */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders(){
        // a user can place many orders
        return $this->hasMany('App/Order');
    }
}
