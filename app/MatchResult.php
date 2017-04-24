<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchResult extends Model
{
    protected $table = 'ticket_sports';

    protected $fillable = ['video', 'honour', 'score'];

    public function sport()
    {
        return $this->belongsTo('App\Sport');
    }

    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }
}
