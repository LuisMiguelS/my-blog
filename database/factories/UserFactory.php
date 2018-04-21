<?php

use App\Post;
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

$factory->state(App\User::class, App\User::ADMIN_ROLE, ['role' => \App\User::ADMIN_ROLE]);

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
    ];
});

$factory->define(App\Tag::class, function (Faker $faker) {
    return [
        'tag' => $faker->unique()->word,
    ];
});

$factory->define(Post::class, function (Faker $faker) {

    return [
        'user_id' => factory(\App\User::class)->create(),
        'category_id' => factory(\App\Category::class)->create(),
        'title' => 'New Laravel Post Title '. $faker->unique()->randomNumber,
        'seo_title' => $faker->paragraph(1),
        'excerpt' => $faker->paragraph(1),
        'body' => $faker->paragraph,
        'meta_description' => $faker->paragraph(1),
        'meta_keywords' => $faker->paragraph(1),
        'status' => $faker->randomElement([Post::PUBLISHED, Post::DRAFT, Post::PENDING]),
    ];
});