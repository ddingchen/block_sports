<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['user_id', 'note'];

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function sports()
    {
        return $this->belongsToMany('App\Sport', 'ticket_sports')->withPivot('video', 'honour')->withTimestamps();
    }

    public function matchResults()
    {
        return $this->hasMany('App\MatchResult');
    }
}
