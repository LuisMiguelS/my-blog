<?php

namespace App\Providers;

use DB;
use App\{Tag, Post, Category};
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->homePage();

        $this->appLayout();

        $this->sidebar();

        $this->nav_menu();

    }

    private function homePage()
    {
        view()->composer('index', function ($view) {

            $carousel = Post::with(['category:id,slug,name'])
                ->where('status', Post::PUBLISHED)
                ->orderBy('id','DESC')
                ->take(7)->get();

            $categories = Category::whereHas('posts', function ($query) {
                $query->where('status', Post::PUBLISHED);
            })->with(['posts' => function($query) {
                $query->orderBy('id','DESC')->take(50);
            }])->limit(5)->get();

            $view->with(compact('carousel', 'categories'));
        });
    }

    private function appLayout()
    {
        view()->composer('layouts.app', function ($view) {
            $hide = !is_null(request()->route())
                && (request()->route()->uri() !== 'register'
                    && request()->route()->getPrefix() !== '/admin'
                    && request()->route()->uri() !== 'login');

            $admin_nav = null;

            if (!is_null(request()->route())) {
                $admin_nav =  request()->route()->getPrefix() === '/admin';
            }

            $ramdom_posts = Post::with(['category:id,slug'])
                ->where('status', Post::PUBLISHED)
                ->orderBy(DB::raw('RAND()'))->take(15)->get();

            $category_footer = Category::pluck('name', 'slug');

            $view->with(compact('hide', 'admin_nav', 'ramdom_posts', 'category_footer'));
        });
    }

    private function sidebar()
    {
        view()->composer('partials.sidebar', function ($view) {

            $archives = Post::archives();

            $tags = Tag::orderBy('id','DESC')->pluck('slug', 'tag')->take(50);

            $lastPost = Post::with(['category:id,slug,name'])
                ->where('status', Post::PUBLISHED)
                ->orderBy('id','DESC')
                ->take(20)->get();

            $post_most_seen = Post::with(['category:id,slug'])
                ->where('status', Post::PUBLISHED)
                ->limit(20)
                ->get()
                ->sortByDesc(function ($posts) {
                    return $posts->getPageViews();
                });

            $view->with(compact('archives', 'tags', 'post_most_seen', 'lastPost'));

        });
    }

    private function nav_menu()
    {
        view()->composer('partials.nav-menu', function ($view) {

            $categories = Category::pluck('name', 'slug')->take(30);

            $view->with(compact('categories'));
        });
    }
}
