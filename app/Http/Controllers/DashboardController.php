<?php

namespace App\Http\Controllers;

use App\{User, Tag, Post, Category};

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::select('user_id','status')->get();

        $post_trashed_count = Post::onlyTrashed()->count();

        $user_count = User::count();

        $user_trashed_count = User::onlyTrashed()->count();

        $category_count = Category::count();

        $category_trashed_count = Category::onlyTrashed()->count();

        $tag_count = Tag::count();

        $tag_trashed_count = Tag::onlyTrashed()->count();

        return view('admin.dashboard',
            compact('posts','post_trashed_count', 'user_count', 'user_trashed_count', 'category_count',
                'category_trashed_count', 'tag_count', 'tag_trashed_count'));
    }
}
