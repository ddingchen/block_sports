<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $fillable = ['id', 'name', 'street_id'];

    public $incrementing = false;

    public $timestamps = false;

    public function street()
    {
        return $this->belongsTo('App\Street');
    }

    public function residentialAreas()
    {
        return $this->hasMany('App\ResidentialArea');
    }
}
