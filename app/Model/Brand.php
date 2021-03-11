<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
    public function Products()
    {
        return $this->hasMany(Product::class);
    }
    public function User()
    {
        return $this->belongsTo('App\User');
    }


    public function getStatusAttribute($attribute)
    {
        return [
            '1' => 'Active',
            '0' => 'Inactive',
        ][$attribute];
    }
}
