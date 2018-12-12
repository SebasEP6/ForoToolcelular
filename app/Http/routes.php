<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
	'uses' => 'HomeController@index',
	'as'   => 'home'
]);

/*
* Global: Users...
*/

Route::get('usuarios', [
	'uses' => 'UsersController@index',
	'as'   => 'members'
]);

Route::get('usuarios/{user?}/{id}', [
	'uses' => 'UsersController@show',
	'as'   => 'profile'
]);

Route::get('usuarios/{user?}/{id}/temas', [
	'uses' => 'UsersController@userTopics',
	'as'   => 'personal_topics'
]);

/*
* Global: Topics...
*/
Route::get('temas', [
	'uses' => 'PostsController@index',
	'as'   => 'all'
]);

/*
* Authenticate: Users...
*/

Route::group(['middleware' => 'auth'], function() {

	/*
	* New: Topics...
	*/

	Route::get('temas/nuevo/tema/{id}', [
		'uses' => 'PostsController@newPost',
		'as'   => 'new'
	]);
	Route::post('temas/nuevo/tema/{id}', [
		'uses' => 'PostsController@create',
		'as'   => 'new-post'
	]);

	Route::post('temas/categoria/new',[
		'uses' => 'PostsController@category',
		'as'   => 'newCategory'
	]);

	Route::post('temas/{id}/nuevo-comentario', [
	'uses' => 'CommentsController@store',
	'as'   => 'newComment'
	]);

	Route::get('temas/categorias/nuevo/me-gusta/{id}', [
		'uses' => 'PostsController@like',
		'as'   => 'like'
	]);

	Route::post('upload',[
		'uses' => 'PostsController@store_file'
	]);

	/*
	* Users: Messages...
	*/

	Route::get('usuarios/{user?}/{id}/mensajes', [
		'uses' => 'MessagesController@index',
		'as'   => 'messages'
	]);

	Route::get('usuarios/ver/mensaje/{id}', [
		'uses' => 'MessagesController@show',
		'as'   => 'message'
	]);

	Route::post('usuarios/ver/mensaje/{receive}/{sent}', [
		'uses' => 'MessagesController@create',
		'as'   => 'new-message'
	]);

	/*
	* Users: Profile...
	*/

	Route::get('usuario/{user?}/{id}/editar', [
		'uses' => 'UsersController@edit',
		'as'   => 'edit-profile'
	]);

	Route::post('usuario/{user?}/{id}/editar', 'UsersController@update');

	/*
	* Admin: Users...
	*/

	Route::get('administrar/usuarios', [
		'uses' => 'UsersController@admin',
		'as'   => 'users'
	]);

	Route::get('administrar/usuarios/{id}/modificar', [
		'uses' => 'UsersController@users',
		'as'   => 'change'
	]);

	Route::post('administrar/usuarios/{id}/modificar', 'UsersController@role');

	/*
	* Admin: Categories...
	*/

	Route::get('administrar/categorias', [
		'uses' => 'PostsController@admin',
		'as'   => 'categories'
	]);

	Route::get('administrar/categorias/{id}/modificar', [
		'uses' => 'PostsController@modify',
		'as'   => 'modify'
	]);

	Route::post('administrar/categorias/{id}/modificar', 'PostsController@modified');

	/*
	* View: Topics...
	*/

	Route::get('temas/{category?}/{id}', [
		'uses' => 'PostsController@topic',
		'as'   => 'topic'
	]);

	Route::post('temas/busqueda', [
		'uses' => 'PostsController@search',
		'as'   => 'srch'
	]);

	/*
	*	Edit...
	*/

	Route::get('tema/{id}', [
		'uses' => 'PostsController@edit',
		'as'   => 'ed_topic'
	]);

	Route::post('tema/{id}', 'PostsController@postEdit');

	Route::get('comentario/{id}', [
		'uses' => 'CommentsController@update',
		'as'   => 'ed_comment'
	]);

	Route::post('comentario/{id}', 'CommentsController@postUpdate');

	/*
	* Delete...
	*/

	Route::get('tema/eliminar/{i}', [
		'uses' => 'PostsController@delete',
		'as'   => 'delPost'
	]);

	/*
	*  Ads...
	*/

	Route::get('publicidad', [
		'uses' => 'AdminController@market',
		'as'   => 'mark'
	]);

	Route::post('publicidad', 'AdminController@postMarket');

	Route::get('publicidad/eliminar/{i}', [
		'uses' => 'AdminController@delete',
		'as'   => 'delAd'
	]);

	Route::group(['prefix' => 'messages', 'namespace' => 'Chat'], function () {
	    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
	    Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
	    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
	    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
	    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
	});

});

// Authentication routes...

Route::get('ingresar', [
	'uses' => 'Auth\AuthController@getLogin',
	'as'   => 'login'
]);
Route::post('ingresar', 'Auth\AuthController@postLogin');

Route::get('finalizo-sesion', [
	'uses' => 'Auth\AuthController@getLogout',
	'as'   => 'logout'
]);

// Registration routes...
Route::get('registrar', [
	'uses' => 'Auth\AuthController@getRegister',
	'as'   => 'register'
]);
Route::post('registrar', 'Auth\AuthController@postRegister');