<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $post_count = Post::count();
        $post_trashed_count = Post::onlyTrashed()->count();
        $user_count = User::count();
        $category_count = Category::count();

        return view('admin.dashboard', compact('post_count','post_trashed_count', 'user_count', 'category_count'));
    }
}
