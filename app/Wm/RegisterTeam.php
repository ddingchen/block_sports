<?php

namespace App\Wm;

use Illuminate\Database\Eloquent\Model;

class RegisterTeam extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($team) {
            $team->registions()->delete();
        });
    }

    public function registions()
    {
        return $this->belongsToMany('App\Wm\Registion', 'team_registions', 'team_id')->withTimestamps();
    }

    public function ticket()
    {
        return $this->morphOne('App\Wm\Ticket', 'registion');
    }
}
