<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    public function run()
    {
        App\Category::create([
            'name' => 'blog'
        ]);
    }
}