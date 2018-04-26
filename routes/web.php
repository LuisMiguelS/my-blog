<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home.index');

Route::get('archives', 'HomeController@archive');

Route::get('search', 'HomeController@search');

Route::get('tags/{slug}','TagController@show');

Route::get('{category_slug}','CategoryController@show')->fallback();

Route::get('{category_slug}/{post_slug}','PostController@show')->fallback();

Route::prefix('admin')->middleware(['auth'])->group(function(){
    require __DIR__ . '/admin/web.php';
});

Route::any('register', function () {
    return redirect()->route('home.index');
});