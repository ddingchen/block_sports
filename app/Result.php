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

    public function getReadableScoreAttribute()
    {
        $suffix = '';
        switch ($this->match->sport->name) {
            case '跳绳':
                $suffix = '次';
                break;
            case '踢毽子':
                $suffix = '个';
                break;
            case '广场舞':
                $suffix = '分';
                break;
            default:
                break;
        }

        return $this->score . $suffix;
    }
}
