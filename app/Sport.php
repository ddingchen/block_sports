<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    protected $fillable = ['id', 'name', 'standard', 'is_group'];

    public $incrementing = false;

    public $timestamps = false;

    public function results()
    {
        return $this->hasManyThrough('App\Result', 'App\Match');
    }

    public function getFileOfGameRuleAttribute()
    {
        return '/doc/2017街区运动会' . $this->name . '规程.docx';
    }
}
