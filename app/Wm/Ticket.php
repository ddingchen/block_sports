<?php

namespace App\Wm;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'wm_tickets';

    protected $datetime = ['paid_at'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($ticket) {
            $ticket->registion->delete();
        });
    }

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function registion()
    {
        return $this->morphTo('registion');
    }

    public function group()
    {
        return $this->belongsTo('App\Wm\Group');
    }
}
