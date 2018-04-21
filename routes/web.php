<?php

Auth::routes();

Route::get('/', [
    'uses' => 'HomeController@index',
    'as' => 'home.index'
]);

/*Route::get('/', [
	'uses' => 'FrontEndController@index',
	'as' => 'index'
]);

Route::get('post/{slug}', [
	'uses' => 'FrontEndController@singlePost',
	'as' => 'post.single'
]);

Route::get('category/{id}', [
	'uses' => 'FrontEndController@category',
	'as' => 'category.single'
]);

Route::get('tag/{id}', [
	'uses' => 'FrontEndController@tag',
	'as' => 'tag.single'
]);

Route::get('search', [
	'uses' => 'FrontEndController@search',
	'as' => 'search'
]);*/

Route::prefix('admin')->middleware(['auth'])->group(function(){

    Route::get('dashboard', 'DashboardController@index')
        ->name('dashboard.index')
        ->middleware('profile');

    /*
     * RUTAS PARA EL MODULO DE LOS POSTS*
     */
    Route::get('posts/draft', 'PostController@draft')->name('posts.draft');
    Route::get('posts/trash', 'PostController@trashed')->name('posts.trashed');
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
     * Rutas de los Roles
     */
    Route::resource('roles', 'RoleController')->except('show');

    /*
     * Ruta de los permisos
     */
    Route::resource('permissions', 'PermissionController')->except('show');

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

});