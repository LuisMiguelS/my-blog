<?php

namespace App\Providers;

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
            $settings = setting()->all();

            config()->set('app.name', $settings['blog']['name']);

            config()->set('blog',  $settings['blog']);

            config()->set('disqus',$settings['disqus']);

            config()->set('shareThis', $settings['shareThis']);

            config()->set('ads', $settings['ads']);



        }catch (\Exception $e) {
            //
        }
    }


}
