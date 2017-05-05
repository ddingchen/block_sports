<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = ['score'];

    public function owner()
    {
        return $this->morphTo();
    }

    public function match()
    {
        return $this->belongsTo('App\Match');
    }
}
