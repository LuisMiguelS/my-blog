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
            ->where('status', Post::PUBLISHED)
            ->whereNull('deleted_at')
            ->paginate(25);

        return view('post.search', compact('posts'));
    }

    public function search()
    {
        $search = request()->validate([
            'q' => 'nullable|min:3|max:255'
        ]);

        $posts = Post::search($search['q'] ?? null)
            ->where('status', Post::PUBLISHED)
            ->whereNull('deleted_at')
            ->paginate(25);

        return view('post.search', compact('posts', 'search'));
    }
}
