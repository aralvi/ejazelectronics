<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function Brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function Stocks()
    {
        return $this->belongsToMany(Stock::class, 'Stocks', 'product_id');
    }

    public function Invoices()
    {
        return $this->belongsToMany(Invoice::class, 'invoice_products', 'invoice_id', 'product_id')->withPivot('price', 'quantity')->withTimestamps();
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }
    public function getStatusAttribute($attribute)
    {
        return[
            '1' => 'Active',
            '0' => 'Inactive',
        ][$attribute];
    }
}
