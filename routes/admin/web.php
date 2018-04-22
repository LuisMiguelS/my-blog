<?php

Route::get('dashboard', 'DashboardController@index')
    ->name('dashboard.index')
    ->middleware('profile');

/*
 * RUTAS PARA EL MODULO DE LOS POSTS*
 */
Route::get('posts/draft', 'PostController@draft')->name('posts.draft');
Route::get('posts/trash', 'PostController@trashed')->name('posts.trashed');
Route::post('posts/trash/restore/{id}', 'PostController@restore')->name('posts.restore');
Route::delete('posts/trash/kill/{id}', 'PostController@kill')->name('posts.kill');
Route::resource('posts', 'PostController')->except('show');

/*
 * RUTAS PARA EL MODULO DE LAS CATEGORIAS
 */
Route::resource('categories', 'CategoryController')->except('show');

/*
 * RUTAS PARA EL MODULO DE LOS TAGS
 */
Route::resource('tags', 'TagController')->except('show');

/*
 * RUTAS PARA EL MODULO DE LOS USUARIOS
 */
Route::resource('users', 'UserController')->except('show');

/*
 * Profile
 */
Route::resource('profile', 'ProfileController')->only(['index','update']);

/*
 * RUTAS PARA LA CONFIG. DEL SITIO
 */
Route::resource('settings', 'SettingController')->only(['index','update']);