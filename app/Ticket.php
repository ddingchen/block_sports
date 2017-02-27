<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['user_id'];

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function sports()
    {
        return $this->belongsToMany('App\Sport', 'ticket_sports');
    }
}
