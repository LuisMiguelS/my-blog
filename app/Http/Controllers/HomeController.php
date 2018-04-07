<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
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
