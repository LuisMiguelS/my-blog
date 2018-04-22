<?php

namespace App\Providers;

use Config;
use App\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        try{
            $settings = Setting::first();

            Config::set('app.name', $settings->site_name);

            Config::set('app.contact', [
                'phone' => $settings->contact_number,
                'email' => $settings->contact_email,
                'address' => $settings->address,
            ]);

        }catch (\Exception $e){
            //
        }
    }
}
