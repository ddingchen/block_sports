<?php

namespace App\Wm;

use Illuminate\Database\Eloquent\Model;

class Registion extends Model
{
    protected $guarded = [];

    public function readableSex()
    {
        if ($this->sex == 'male') {
            return '男';
        } elseif ($this->sex == 'female') {
            return '女';
        }
        return '';
    }

    public function registerTeams()
    {
        return $this->belongsToMany('App\Wm\RegisterTeam', 'team_registions', 'registion_id', 'team_id')->withTimestamps();
    }

    public function ticket()
    {
        return $this->morphOne('App\Wm\Ticket', 'registion');
    }

    public function getTeam()
    {
        return $this->registerTeams->first();
    }

    public function registerGroup()
    {
        $ticket = $this->ticket ?: $this->getTeam()->ticket;
        return $ticket->group;
    }
}
