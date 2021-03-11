<?php

namespace App;

use App\Model\Brand;
use App\Model\Category;
use App\Model\Invoice;
use App\Model\Product;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRoleAttribute($attribute)
    {
        return[
            '1'=> 'Admin',
            '0'=> 'User'
        ][$attribute];
    }
    public function getStatusAttribute($attribute)
    {
        return[
            '1'=> 'Active',
            '0'=> 'Inactive'
        ][$attribute];
    }

    public function Brands()
    {
        return $this->hasMany('App\Model\Brand');
    }
    public function Categories()
    {
        return $this->hasMany(Category::class);
    }
    public function Invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    public function Products()
    {
        return $this->hasMany(Product::class);
    }

}
