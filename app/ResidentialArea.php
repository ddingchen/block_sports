<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResidentialArea extends Model
{
    protected $fillable = ['id', 'name'];

    public $incrementing = false;

    public $timestamps = false;

    public function block()
    {
        return $this->belongsTo('App\Block');
    }
}
