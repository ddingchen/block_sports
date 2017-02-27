<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $fillable = ['id', 'name'];

    public $incrementing = false;

    public $timestamps = false;

    public function residentialAreas()
    {
        return $this->hasMany('App\ResidentialArea');
    }
}
