<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['user_id', 'match_id', 'note'];

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function match()
    {
        return $this->belongsTo('App\Match');
    }

    public function sports()
    {
        return $this->belongsToMany('App\Sport', 'ticket_sports')->withPivot('video', 'honour', 'team_name')->withTimestamps();
    }

    public function ticketSports()
    {
        return $this->hasMany('App\TicketSport');
    }

    public function matchResults()
    {
        return $this->hasMany('App\MatchResult');
    }
}
