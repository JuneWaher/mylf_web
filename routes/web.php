<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Mail\UserRegister;

//===== PUBLIC ROUTES

Route::get('/', 'HomeController@index')->name('home');

Route::get('/sendmail', function() {
	$data['username'] = Auth::user()->name;
	Mail::to(Auth::user()->email)->send(new UserRegister($data));
});

Auth::routes();

//===== Non registered can see the game and article list
Route::get('/games', 'GameController@index')->name('game.list');
Route::get('/articles', 'ArticleController@index')->name('article.list');

Route::group(['middleware' => 'auth'], function () {
	Route::group(['middleware' => 'Admin'], function () {
		
		Route::get('/admin', 'AdminController@index');
		
		//========================== ADMIN GAME
		Route::get('/admin/games', 'AdminController@games')->name('admin.game.list');
		Route::get('/admin/game/{game}', 'AdminController@gameshow')->name('admin.game.show');
		Route::post('/admin/games/{game}/promote', 'AdminController@acceptGame')->name('admin.game.promote');
		Route::post('/admin/games/{game}/demote', 'AdminController@demote')->name('admin.game.demote');
		Route::delete('admin/game/{game}', 'GameController@destroy')->name('game.destroy');
		
		
		//========================== ADMIN USERS
		Route::get('/admin/members', 'AdminController@users')->name('admin.user.list');
		Route::post('/admin/members/{user}/promote', 'AdminController@promoteuser')->name('admin.user.promote');
		Route::post('/admin/members/{user}/demote', 'AdminController@demoteuser')->name('admin.user.demote');
		Route::delete('/admin/members/{user}', 'UserController@destroy')->name('user.destroy');
		
		
		//========================== ADMIN ARTICLES
		Route::get('/admin/articles', 'AdminController@articles')->name('admin.article.list');
		// Route::get('/admin/article/{article}', 'AdminController@articleshow')->name('admin.article.show');
		Route::delete('/admin/article/{article}', 'ArticleController@destroy')->name('article.destroy');
	});

	//====== GAMES
	Route::get('/game/create', 'GameController@create')->name('game.create');
	Route::post('/game/create', 'GameController@store')->name('game.store');
	Route::get('/game/{game}', 'GameController@show')->name('game.show');
	Route::get('/game/{game}/edit', 'GameController@edit')->name('game.edit');
	Route::put('/game/{game}/edit', 'GameController@update')->name('game.update');
	Route::post('/game/{game}/sub', 'GameController@subscribe')->name('game.sub');
	Route::post('/game/{game}/unsub', 'GameController@unsub')->name('game.unsub');

	//====== ARTICLES
	Route::get('/article/create', 'ArticleController@create')->name('article.create');
	Route::post('/article/create', 'ArticleController@store')->name('article.store');
	Route::get('/article/{article}', 'ArticleController@show')->name('article.show');

	//====== MEMBERS
	Route::get('/members', 'UserController@index')->name('member.list');
	Route::get('/member/{user}', 'UserController@show')->name('member.show');

	//====== USER PROFILE
	Route::get('/profile', 'UserController@profile')->name('profile');
	Route::get('/profile/edit', 'UserController@edit')->name('profile.edit');
});
