<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminRequest extends Model
{
    protected $fillable = ['user_id', 'email', 'note'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
