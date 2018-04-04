<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Setting::create([
        	'site_name' => "Laravel's Blog",
        	'Address' => 'Dom. Rep.',
        	'contact_number' => '000-897-8790',
        	'contact_email' => 'info@laravel_blog.com'
        ]);
    }
}
