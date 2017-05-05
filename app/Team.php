<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name'];

    public function leader()
    {
        return $this->belongsTo('App\User', 'leader_id');
    }

    public function members()
    {
        return $this->belongsToMany('App\User', 'team_members')->withTimestamps();
    }
}
