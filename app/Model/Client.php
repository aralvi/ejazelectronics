<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function Invoice()
    {
        return $this->hasMany(Invoice::class);
    }
    public function getStatusAttribute($attribute)
    {
        return [
            '1' => 'Active',
            '0' => 'Inactive',
        ][$attribute];
    }
    public function getRoleAttribute($attribute)
    {
        return [
            '1' => 'Permanent',
            '0' => 'Local',
        ][$attribute];
    }
}
