<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    protected $fillable = ['id', 'name'];

    public $incrementing = false;

    public $timestamps = false;

    public function getFileOfGameRuleAttribute()
    {
        return '/doc/' . $this->name . '赛制规则.docx';
    }
}
