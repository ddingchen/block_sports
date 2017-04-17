<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'tel', 'open_id', 'nickname', 'sex', 'age', 'avatar', 'residential_area_id', 'custom_area',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function residentialArea()
    {
        return $this->belongsTo('App\ResidentialArea');
    }

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    public function adminRequest()
    {
        return $this->hasOne('App\AdminRequest');
    }
}
