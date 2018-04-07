<?php

use App\Tag;
use App\User;
use App\Post;
use App\Profile;
use App\Setting;
use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Post::truncate();
        Tag::truncate();
        Category::truncate();
        Profile::truncate();
        Setting::truncate();
        DB::table('post_tag')->truncate();

        $this->call(SettingsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
    }
}