<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function Brands()
    {
        return $this->hasMany(Brand::class);
    }
    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function getStatusAttribute($attribute)
    {
        return[
            '1' => 'Active',
            '0' => 'Inactive'
        ][$attribute];
    }
}
