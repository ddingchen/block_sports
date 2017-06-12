<?php

namespace App\Wm;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function tickets()
    {
        return $this->hasMany('App\Wm\Ticket');
    }
}
