<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public function User()
    {
        return $this->belongsTo('App\User');;
    }
}
