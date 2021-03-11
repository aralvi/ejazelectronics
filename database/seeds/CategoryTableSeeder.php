<?php

use App\Model\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            $category = new Category();
            $category->user_id = '1';
            $category->name = 'Category ' . $i;
            $category->status = '1';
            $category->save();
        }
    }
}
