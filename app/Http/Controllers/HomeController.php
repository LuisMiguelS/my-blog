<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Category;
use App\Setting;
use App\Tag;

class HomeController extends Controller
{
    public function index()
    {
     /*   'title' => Setting::first()->site_name,
        'categories' => Category::take(5)->get(),
        'first_post' => Post::orderBy('created_at', 'desc')->first(),
        'second_post' => Post::orderBy('created_at', 'desc')->skip(1)->take(1)->get()->first(),
        'third_post' => Post::orderBy('created_at', 'desc')->skip(2)->take(1)->get()->first(),
        'plum_sg' => Category::find(2),
        'emily_rudd' => Category::find(1),
        'settings' => Setting::first()*/
    	return view('index');
    }

    public function singlePost($slug)
    {
    	/*$post = Post::where('slug', $slug)->first();

    	$next_id = Post::where('id', '>', $post->id)->min('id');

    	$prev_id = Post::where('id', '<', $post->id)->max('id');*/

     /*   'post' => $post,

    		'title' => $post->title,
    		'categories' => Category::take(5)->get(),
    		'settings' => Setting::first(),
    		'tags' => Tag::all(),
    		'next_post' => Post::find($next_id),
    		'prev_post' => Post::find($prev_id)
    	]*/

    	//return view('single');
    }

 /*   public function category($id)
    {
        $category = Category::find($id);

        return view('category', [
            'category' => $category,
            'title' => $category->name,
            'categories' => Category::take(5)->get(),
            'settings' => Setting::first(),
            'tags' => Tag::all()
        ]);
    }

    public function tag($id)
    {
        $tag = Tag::find($id);

        return view('tag', [
            'tag' => $tag,
            'title' => $tag->tag,
            'categories' => Category::take(5)->get(),
            'settings' => Setting::first(),
            'tags' => Tag::all()
        ]);
    }

    public function search()
    {
        $posts = Post::where('title', 'like', '%'.request('query').'%')->orderBy('id', 'desc')->get();

        return view('results', [
            'posts' => $posts,
            'title' => 'Search results',
            'categories' => Category::take(5)->get(),
            'settings' => Setting::first(),
            'tags' => Tag::all(),
            'search' => request('query')
        ]);
    }*/
}
