<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InvoiceProducts extends Model
{
   public function Products()
   {
       return $this->hasMany(Product::class);
   }
}
