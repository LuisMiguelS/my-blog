<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    public function run()
    {
        //Creando algunas categorias
        App\Category::create([
            'name' => 'Emily Rudd'
        ]);

        App\Category::create([
            'name' => 'Plum SG'
        ]);

        App\Category::create([
            'name' => 'Beautiful Woman'
        ]);

        App\Category::create([
            'name' => 'Nice Girls'
        ]);
    }
}