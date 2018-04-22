<?php

namespace App\Http\Controllers;

use App\Post;

class HomeController extends Controller
{
    public function index()
    {
    	return view('index');
    }

    public function archive()
    {
        $posts = Post::filter([request()->month, request()->year])
            ->published();

        return view('post.search', compact('posts'));
    }

    public function search()
    {
        $posts = Post::search(request()->q)->published();

        return view('post.search', compact('posts'));
    }
}
