<?php

use App\Model\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=5;$i++){
            $brand = new Brand();
            $brand->user_id = '1';
            $brand->name = 'Brand '.$i;
            $brand->category_id = $i;
            $brand->save();
        }
    }
}
