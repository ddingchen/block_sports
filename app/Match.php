<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = ['street_id'];

    public function street()
    {
        return $this->belongsTo('App\Street');
    }

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    public function sports()
    {
        return $this->belongsToMany('App\Sport', 'match_sports')->withTimestamps();
    }

    public function group()
    {
        return $this->belongsTo('App\MatchGroup');
    }

    public function hasGroupSport()
    {
        return $this->sports->contains(function ($sport) {
            return $sport->is_group;
        });
    }
}
