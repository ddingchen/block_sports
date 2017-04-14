<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchGroup extends Model
{
    protected $fillable = ['name', 'title', 'sub_title', 'top'];

    public function matches()
    {
        return $this->hasMany('App\Match', 'group_id');
    }
}
