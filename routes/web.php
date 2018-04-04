<?php

#**********************RUTAS PARA GESTIONAR EL FRONT END DEL BLOG **********************#

Route::get('/', [
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
]);

#***********RUTAS PARA EL MODULO DE AUTENTICACION (CREADA POR LARAVEL) ***********#

Auth::routes();


#****************************************************************************************#

/*Esto es un ejemplo del metodo que se creó en el modelo de Category. Tal metodo
  fue creado para indicar la relacion entre Post y Category
  (una categoria puede tener varios posts). De manera que, este metodo extrae de la BD
  todo los posts que corresponden a dicha categoria.
				
				Route::get('/test', function () {
				    return App\Category::find(1)->posts;
				});
*/

Route::get('/test', function () {
    return App\User::find(2)->posts;
});

#****************************************************************************************#



#Rutas del proyecto Blog#
#-----------------------#

//Grupo de rutas rejidas bajo el prefijo "admin" y con login requerido

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
	
	//Ruta despues de un usuario autenticarse (ponerle "/admin/home" al controller: RedirectAuthenticated.php y RegistredController.php)
	Route::get('/dashboard', 'HomeController@index')->name('home');

	
	#**********************RUTAS PARA EL MODULO DE LOS POSTS**********************#

	//Llama la vista para invocar el formulario de crear el post
	Route::get('post/create', [
		'uses' => 'PostsController@create',
		'as' => 'post.create'
	]);

	//Guarda un nuevo post
	Route::post('post/store', [
		'uses' => 'PostsController@store',
		'as' => 'post.store'
	]);

	//Ver posts
	Route::get('posts', [
		'uses' => 'PostsController@index',
		'as' => 'posts'
	]);

	//Invoca el formulario para editar un post
	Route::get('post/edit/{id}', [
		'uses' => 'PostsController@edit',
		'as' => 'post.edit'
	]);

	//Elimina un post (no de la BD)
	Route::get('post/trash/{id}', [
		'uses' => 'PostsController@destroy',
		'as' => 'post.trash'
	]);

	//Elimina un post (permanentemente)
	Route::get('post/kill/{id}', [
		'uses' => 'PostsController@kill',
		'as' => 'post.kill'
	]);

	//Actualiza un post
	Route::post('post/update/{id}', [
		'uses' => 'PostsController@update',
		'as' => 'post.update'
	]);

	//Ver posts borrados
	Route::get('posts/trashed', [
		'uses' => 'PostsController@trashed',
		'as' => 'posts.trashed'
	]);

	//Restaura un post borrado
	Route::get('post/restore/{id}', [
		'uses' => 'PostsController@restore',
		'as' => 'post.restore'
	]);


	#**********************RUTAS PARA EL MODULO DE LAS CATEGORIAS**********************#

	//Invoca el formulario para crear una nueva categoria
	Route::get('category/create', [
		'uses' => 'CategoriesController@create',
		'as' => 'category.create'
	]);

	//Guarda una nueva categoria
	Route::post('category/store', [
		'uses' => 'CategoriesController@store',
		'as' => 'category.store'
	]);

	//Ver categorias
	Route::get('categories', [
		'uses' => 'CategoriesController@index',
		'as' => 'categories'
	]);

	//Invoca el formulario para editar una categoria
	Route::get('category/edit/{id}', [
		'uses' => 'CategoriesController@edit',
		'as' => 'category.edit'
	]);

	//Elimina una categoria
	Route::get('category/delete/{id}', [
		'uses' => 'CategoriesController@destroy',
		'as' => 'category.delete'
	]);

	//Actualiza una categoria
	Route::post('category/update/{id}', [
		'uses' => 'CategoriesController@update',
		'as' => 'category.update'
	]);


	#**********************RUTAS PARA EL MODULO DE LOS TAGS**********************#

	//Invoca el formulario para crear un nuevo tag
	Route::get('tag/create', [
		'uses' => 'TagsController@create',
		'as' => 'tag.create'
	]);

	//Guarda un nuevo tag
	Route::post('tag/store', [
		'uses' => 'TagsController@store',
		'as' => 'tag.store'
	]);

	//Ver tags
	Route::get('tags', [
		'uses' => 'TagsController@index',
		'as' => 'tags'
	]);

	//Invoca el formulario para editar un tag
	Route::get('tag/edit/{id}', [
		'uses' => 'TagsController@edit',
		'as' => 'tag.edit'
	]);

	//Elimina un tag
	Route::get('tag/delete/{id}', [
		'uses' => 'TagsController@destroy',
		'as' => 'tag.delete'
	]);

	//Actualiza un tag
	Route::post('tag/update/{id}', [
		'uses' => 'TagsController@update',
		'as' => 'tag.update'
	]);


	#**********************RUTAS PARA EL MODULO DE LOS USUARIOS**********************#

	//Ver usuarios
	Route::get('users', [
		'uses' => 'UsersController@index',
		'as' => 'users'
	]);

	//Elimina un usuario
	Route::get('user/delete/{id}', [
		'uses' => 'UsersController@destroy',
		'as' => 'user.delete'
	]);

	//Crea un nuevo usuario
	Route::get('user/create', [
		'uses' => 'UsersController@create',
		'as' => 'user.create'
	]);

	//Guarda un nuevo usuario
	Route::post('user/store', [
		'uses' => 'UsersController@store',
		'as' => 'user.store'
	]);

	//Convierte a Admin un usuario
	Route::get('user/admin/{id}', [
		'uses' => 'UsersController@admin',
		'as' => 'user.admin'
	]);

	//Quita privilegio de Admin a un usuario
	Route::get('user/not-admin/{id}', [
		'uses' => 'UsersController@notAdmin',
		'as' => 'user.not-admin'
	]);

	//Muestra el profile de el usuario logueado
	Route::get('user/profile', [
		'uses' => 'ProfilesController@index',
		'as' => 'user.profile'
	]);

	//Actualiza el profile de un usuario
	Route::post('user/profile/update', [
		'uses' => 'ProfilesController@update',
		'as' => 'user.profile.update'
	]);


	#**********************RUTAS PARA LA CONFIG. DEL SITIO**********************#
	
	//Ver settings
	Route::get('settings', [
		'uses' => 'SettingsController@index',
		'as' => 'settings'
	]);

	//Actualiza el profile de un usuario
	Route::post('setting/update', [
		'uses' => 'SettingsController@update',
		'as' => 'setting.update'
	]);
});