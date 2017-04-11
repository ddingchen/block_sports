<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = ['id', 'name'];
}
