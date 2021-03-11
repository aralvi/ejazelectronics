<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function Products()
    {
        return $this->belongsToMany(Product::class,'invoice_products', 'invoice_id','product_id' )->withPivot('price','quantity')->withTimestamps();
    }
    public function User()
    {
        return $this->belongsTo('App\User');
    }
    public function Client()
    {
        return $this->belongsTo(Client::class);
    }
}
