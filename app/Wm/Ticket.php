<?php

namespace App\Wm;

use App\Wm\RegisterTeam;
use App\Wm\Registion;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'wm_tickets';

    protected $datetime = ['paid_at'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($ticket) {
            $ticket->registion->delete();
        });
    }

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function registion()
    {
        return $this->morphTo('registion');
    }

    public function group()
    {
        return $this->belongsTo('App\Wm\Group');
    }

    public function isTicketOwner($idcardNo, $realname)
    {
        $registion = $this->registion;
        if ($registion instanceof RegisterTeam) {
            return $registion->registions->contains(function ($item) use ($idcardNo, $realname) {
                return $item->idcard_no == $idcardNo && $item->realname == $realname;
            });
        } else {
            return $registion->idcard_no == $idcardNo && $registion->realname == $realname;
        }
        return false;
    }
}
