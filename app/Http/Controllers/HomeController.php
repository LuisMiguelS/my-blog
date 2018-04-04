<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Category;
use App\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.dashboard', [
            'post_count' => Post::count(),
            'post_trashed_count' => Post::onlyTrashed()->count(),
            'user_count' => User::count(),
            'category_count' => Category::count()
        ]);
    }
}
