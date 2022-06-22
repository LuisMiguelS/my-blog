<?php

namespace App\Providers;

use DB;
use App\{Tag, Post, Category, Anuncio};
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

        $this->showPost();

        $this->footer();

        $this->frontEnd();
    }

    private function homePage()
    {
        view()->composer('index', function ($view) {

            $carousel = Post::with(['category:id,slug,name'])
                ->where('status', Post::PUBLISHED)
                ->orderBy('id','DESC')
                ->take(7)->get();

            /*$categories = Category::whereHas('posts', function ($query) {
                $query->where('status', Post::PUBLISHED);
            })->with(['posts' => function($query) {
                $query->orderBy('id','DESC')->take(90);
            }])->limit(5)->get();*/

            $categories = DB::select("
                SELECT
                    title,
                    slug,
                    excerpt,
                    image,
                    categoria,
                    categoria_slug,
                    username,
                    CAST(created_at AS DATETIME) AS created_at,
                    category_id,
                    row_id_category
                FROM
                    (
                        SELECT
                            p.*,
                            IF(@category_id = p.category_id, @row_id_category := @row_id_category + 1, @row_id_category := 1) AS row_id_category,
                            @category_id := p.category_id
                        FROM
                            (
                                SELECT
                                    c.category_id,
                                    p.title,
                                    p.slug,
                                    p.image,
                                    p.excerpt,
                                    c.categoria,
                                    c.slug AS categoria_slug,
                                    u.name AS username,
                                    p.created_at
                                FROM
                                    (
                                        SELECT
                                            c.id AS category_id,
                                            c.`name` AS categoria,
                                            c.slug
                                        FROM
                                            categories AS c
                                        WHERE
                                            c.deleted_at IS NULL
                                        LIMIT
                                            5
                                    ) AS c
                                        INNER JOIN
                                    posts AS p ON c.category_id = p.category_id
                                        INNER JOIN
                                    users AS u ON p.user_id = u.id
                                WHERE
                                    p.`status` = 'PUBLISHED'
                                        AND p.deleted_at IS NULL
                                ORDER BY
                                    c.category_id ASC,
                                    p.id DESC
                            ) AS p
                                INNER JOIN
                            (SELECT @category_id := 0, @row_id_category := 0) AS r
                    ) AS `posts`
                WHERE
                    row_id_category <= 16
                ORDER BY
                    category_id ASC
                ;
            ");

            $lastPost = Post::with(['category:id,slug,name'])
                ->where('status', Post::PUBLISHED)
                ->whereNull('deleted_at')
                ->orderBy('id','DESC')
                ->take(20)->get();

            $anuncio = Anuncio::orderBy('id_anuncio', 'ASC')->get();

            $view->with(compact('carousel', 'categories', 'lastPost', 'anuncio'));
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

            /*$ramdom_posts = Post::with(['category:id,slug'])
                ->where('status', Post::PUBLISHED)
                ->orderBy(DB::raw('RAND()'))->take(15)->get();*/

            // $category_footer = Category::pluck('name', 'slug');

            $view->with(compact('hide', 'admin_nav'));
        });
    }

    private function showPost ()
    {
        view()->composer('post.show', function ($view) {

            $lastPost = Post::with(['category:id,slug,name'])
                ->where('status', Post::PUBLISHED)
                ->whereNull('deleted_at')
                ->orderBy('id','DESC')
                ->take(20)->get();

            $view->with(compact('lastPost'));
        });
    }

    private function sidebar()
    {
        view()->composer('partials.sidebar', function ($view) {

            $archives = Post::archives();

            $tags = Tag::orderBy('id','DESC')->pluck('slug', 'tag')->take(50);

            $lastPost = Post::with(['category:id,slug,name'])
                ->where('status', Post::PUBLISHED)
                ->whereNull('deleted_at')
                ->orderBy('id','DESC')
                ->take(20)->get();

            $post_most_seen = DB::select("
                SELECT
                    posts.title,
                    posts.slug,
                    posts.image,
                    categories.slug AS category,
                    users.name AS username,
                    posts.created_at
                FROM
                    (
                        SELECT
                            pv.visitable_id AS id_post,
                            COUNT(1) AS cantidad
                        FROM
                            notidigitalrd.`page-views` AS pv
                        GROUP BY
                            pv.visitable_id
                        HAVING
                            COUNT(1) >= 25
                        ORDER BY
                            pv.visitable_id DESC
                        LIMIT
                            25
                    ) AS most_views
                        INNER JOIN
                    posts ON most_views.id_post = posts.id
                        INNER JOIN
                    categories ON posts.category_id = categories.id
                        INNER JOIN
                    users ON posts.user_id = users.id
                WHERE
                    posts.`status` = 'PUBLISHED'
                ;
            ");

            $anuncio = Anuncio::orderBy('id_anuncio', 'ASC')->get();

            $view->with(compact('post_most_seen', 'archives', 'lastPost', 'tags', 'anuncio'));

            // $view->with(compact('archives', 'tags', 'post_most_seen', 'lastPost'));
        });
    }

    private function nav_menu()
    {
        view()->composer('partials.nav-menu', function ($view) {

            $categories = Category::pluck('name', 'slug')->take(30);

            $view->with(compact('categories'));
        });
    }

    private function footer ()
    {
        view()->composer('partials.footer', function ($view) {

            $categories = Category::pluck('name', 'slug')->take(30);

            $carousel = Post::with(['category:id,slug,name'])
                ->where('status', Post::PUBLISHED)
                ->orderBy('id','DESC')
                ->take(5)->get();

            $view->with(compact('categories', 'carousel'));
        });
    }

    private function frontEnd ()
    {
        view()->composer('layouts.front-end', function ($view) {

            $anuncio = Anuncio::orderBy('id_anuncio', 'ASC')->get();

            $categories = Category::pluck('name', 'slug')->take(30);

            $view->with(compact('anuncio', 'categories'));
        });
    }
}