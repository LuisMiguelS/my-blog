<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => 'secret',
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(App\Post::class, function (Faker $faker) {
    $user = \App\User::all()->random();
    $category = \App\Category::all()->random();

    return [
        'thumbnails' => 'imagen.png',
        'title' => $title = 'Title Post '. $faker->randomDigit,
        'slug' =>  str_slug($title, '-'),
        'content' => 'Contenido del Post',
        'user_id' => $user->id,
        'category_id' => $category->id
    ];
});