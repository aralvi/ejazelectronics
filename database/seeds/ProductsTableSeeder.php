<?php

use App\Model\Product;
use App\Model\Stock;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=5;$i++){
            $product = new Product();
            $product->brand_id = $i;
            $product->user_id = '1';
            $product->name = 'Product '.$i;
            $product->stock = '10';
            $product->price = '100';
            $product->retail = '100';
            $product->barcode = '1001245785487';
            $product->save();
            $stock = new Stock();
            $stock->product_id = $product->id;
            $stock->new_stock = '10';
            $stock->user_id = '1';
            $stock->date = '10-08-2020';
            $stock->save();
        }
    }
}
