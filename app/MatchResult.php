<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchResult extends Model
{
    protected $table = 'ticket_sports';

    protected $fillable = ['video', 'honour', 'score'];

    public function sport()
    {
        return $this->belongsTo('App\Sport');
    }

    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }

    public function getReadableScoreAttribute()
    {
        $suffix = '';
        switch ($this->sport->name) {
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
