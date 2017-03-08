<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResidentialArea extends Model
{
    protected $fillable = ['id', 'name', 'py'];

    public $incrementing = false;

    public $timestamps = false;

    public function block()
    {
        return $this->belongsTo('App\Block');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
