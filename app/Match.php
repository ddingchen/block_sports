<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = ['title', 'sub-title'];

    public function sport()
    {
        return $this->belongsTo('App\Sport');
    }

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    public function results()
    {
        return $this->hasMany('App\Result');
    }
}
