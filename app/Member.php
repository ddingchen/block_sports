<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'team_members';

    protected $fillable = ['alias'];

    public function team()
    {
        return $this->belongsTo('App\Team');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getNameAttribute()
    {
        return $this->alias ?: ($this->user->name ?: $this->user->nickname);
    }
}
