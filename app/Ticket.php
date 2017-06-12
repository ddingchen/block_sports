<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['note'];

    public function owner()
    {
        return $this->morphTo();
    }

    public function match()
    {
        return $this->belongsTo('App\Match');
    }

    public function getResultAttribute()
    {
        return $this->match->results->first(function ($result) {
            return $result->owner == $this->owner;
        });
    }
}
