<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Category;
use App\Setting;
use App\Tag;

class FrontEndController extends Controller
{
    public function index()
    {
    	return view('index', [
    		//Estos datos son para alimentar el front-end
    		'title' => Setting::first()->site_name,
    		'categories' => Category::take(5)->get(), //obtiene los primeros 4 resultados

    		'first_post' => Post::orderBy('created_at', 'desc')->first(),
    		'second_post' => Post::orderBy('created_at', 'desc')->skip(1)->take(1)->get()->first(), //skip(1) omite el primer resultado
    		'third_post' => Post::orderBy('created_at', 'desc')->skip(2)->take(1)->get()->first(),
    		'plum_sg' => Category::find(2),
    		'emily_rudd' => Category::find(1),
    		'settings' => Setting::first()
    	]);
    }

    public function singlePost($slug)
    {
    	$post = Post::where('slug', $slug)->first();

    	//Suponiendo que el post solicitado es de id = 5
    	//Busca el los id mayores y obtiene el minimo de ellos.: ex: 6,7,8,9 (min = 6)
    	$next_id = Post::where('id', '>', $post->id)->min('id');
    	
    	//Busca el los id menores y obtiene el maxiomo de ellos.: ex: 4,3,2,1 (max = 4)
    	$prev_id = Post::where('id', '<', $post->id)->max('id');

    	return view('single', [
    		'post' => $post,

    		//Estos datos son para alimentar el front-end
    		'title' => $post->title,
    		'categories' => Category::take(5)->get(), //obtiene los primeros 5 resultados
    		'settings' => Setting::first(),
    		'tags' => Tag::all(),
    		'next_post' => Post::find($next_id),
    		'prev_post' => Post::find($prev_id)
    	]);
    }

    public function category($id)
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
    }
}
