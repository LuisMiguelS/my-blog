<?php

use App\{Profile};
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('post_tag')->truncate();

        Profile::truncate();

        $this->call(UserSeed::class);
        $this->call(CategorySeeder::class);
        $this->call(PostSeeder::class);
        $this->call(TagSeed::class);
        $this->call(SettingsTableSeeder::class);
    }
}