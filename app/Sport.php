<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    protected $fillable = ['id', 'name', 'standard', 'is_group'];

    public $incrementing = false;

    public $timestamps = false;

    public function matchResults()
    {
        return $this->hasMany('App\MatchResult');
    }

    public function getFileOfGameRuleAttribute()
    {
        return '/doc/2017街区运动会' . $this->name . '规程.docx';
    }
}
