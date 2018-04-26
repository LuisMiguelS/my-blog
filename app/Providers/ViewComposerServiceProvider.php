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

            $ramdom_posts = $this->ramdomPost();

            $carousel = Post::with(['category:id,slug,name'])
                ->where('status', Post::PUBLISHED)
                ->orderBy('id','DESC')
                ->take(5)->get();

            $sideCarousel = Post::with(['category:id,slug,name'])
                ->where('status', Post::PUBLISHED)
                ->orderBy('id','DESC')
                ->skip(5)->take(2)->get();

            $lastPost = Post::with(['category:id,slug,name'])
                ->where('status', Post::PUBLISHED)
                ->orderBy('id','DESC')
                ->skip(7)->take(15)->get();

            $view->with(compact('carousel', 'sideCarousel', 'lastPost', 'ramdom_posts'));
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

            $ramdom_posts = $this->ramdomPost();

            $category_footer = Category::pluck('name', 'slug');

            $view->with(compact('hide', 'admin_nav', 'ramdom_posts', 'category_footer'));
        });
    }

    private function ramdomPost()
    {
        return Post::with(['category:id,slug'])
            ->where('status', Post::PUBLISHED)
            ->orderBy(DB::raw('RAND()'))->take(15)->get();
    }

    private function sidebar()
    {
        view()->composer('partials.sidebar', function ($view) {

            $archives = Post::archives();

            $tags = Tag::orderBy('id','DESC')->pluck('slug', 'tag')->take(50);


            $post_most_seen = Post::with(['category:id,slug'])
                ->where('status', Post::PUBLISHED)
                ->limit(20)
                ->get()
                ->sortByDesc(function ($posts) {
                    return $posts->getPageViews();
                });

            $view->with(compact('archives', 'tags', 'post_most_seen'));

        });
    }

    private function nav_menu()
    {
        view()->composer('partials.nav-menu', function ($view) {

            $firts_4_categories = Category::pluck('name', 'slug')->take(10);

            $others_categories = Category::select('name', 'slug')->skip(10)->take(10)->pluck('name', 'slug');

            $view->with(compact('firts_4_categories', 'others_categories'));
        });
    }
}
