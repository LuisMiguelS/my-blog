<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    public function run()
    {
        Category::truncate();

        factory(Category::class)->times(10)->create();
    }
}