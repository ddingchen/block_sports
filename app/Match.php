<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = ['street_id'];

    public function street()
    {
        return $this->belongsTo('App\Street');
    }
}
