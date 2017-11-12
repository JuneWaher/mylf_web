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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/sendmail', function() {
	$data['username'] = Auth::user()->name;
	Mail::to(Auth::user()->email)->send(new UserRegister($data));
});

Auth::routes();

Route::get('/game/create', 'GameController@create')->name('game.create');
Route::post('/game/create', 'GameController@store')->name('game.store');

Route::get('/article/create', 'ArticleController@create')->name('article.create');
Route::post('/article/create', 'ArticleController@store')->name('article.store');

Route::get('/articles', 'ArticleController@index')->name('article.list');
Route::get('/members', 'UserController@index')->name('member.list');
Route::get('/games', 'GameController@index')->name('game.list');

Route::get('/article/{article}', 'ArticleController@show')->name('article.show');
Route::get('/member/{user}', 'UserController@show')->name('member.show');
Route::get('/game/{game}', 'GameController@show')->name('game.show');

Route::get('/game/{game}/edit', 'GameController@edit')->name('game.edit');
Route::put('/game/{game}/edit', 'GameController@update')->name('game.update');



Route::group(['middleware' => 'auth'], function () {
	Route::group(['middleware' => 'Admin'], function () {
		
		Route::get('/admin', 'AdminController@index');
		
		Route::get('/admin/games', 'AdminController@games')->name('admin.game.list');
		Route::get('/admin/game/{game}', 'AdminController@gameshow')->name('admin.game.show');
		Route::post('/admin/games/{game}/promote', 'AdminController@acceptGame')->name('admin.game.promote');
		Route::post('/admin/games/{game}/demote', 'AdminController@demote')->name('admin.game.demote');
		Route::delete('admin/game/{game}', 'GameController@destroy')->name('game.destroy');
		
		Route::get('/admin/members', 'AdminController@users')->name('admin.user.list');
	});

	Route::post('/game/{game}/sub', 'GameController@subscribe')->name('game.sub');
	Route::post('/game/{game}/unsub', 'GameController@unsub')->name('game.unsub');
	Route::get('/profile', 'UserController@profile')->name('profile');
	Route::get('/profile/edit', 'UserController@edit')->name('profile.edit');
});
