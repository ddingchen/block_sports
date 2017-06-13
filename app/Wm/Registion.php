<?php

namespace App\Wm;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Registion extends Model
{
    protected $guarded = [];

    public function registerTeams()
    {
        return $this->belongsToMany('App\Wm\RegisterTeam', 'team_registions', 'registion_id', 'team_id')->withTimestamps();
    }

    public function ticket()
    {
        return $this->morphOne('App\Wm\Ticket', 'registion');
    }

    public function registerGroup()
    {
        $ticket = $this->ticket ?: $this->getTeam()->ticket;
        return $ticket->group;
    }

    public function getTeam()
    {
        return $this->registerTeams->first();
    }

    public function readableSex()
    {
        if ($this->sex == 'male') {
            return '男';
        } elseif ($this->sex == 'female') {
            return '女';
        }
        return '';
    }

    public function getBirthday()
    {
        return Carbon::createFromFormat('Ymd', substr($this->idcard_no, 6, 8));
    }
}
