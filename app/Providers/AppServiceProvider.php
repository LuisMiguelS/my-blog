<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {

            $admin_nav = request()->route()->getPrefix() === '/admin';

            $view->with(compact('admin_nav'));

        });

        view()->composer('partials.sidebar', function ($view) {

            $archives = \App\Post::archives();

            $tags = \App\Tag::pluck('slug', 'tag');

            $view->with(compact('archives', 'tags'));

        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
