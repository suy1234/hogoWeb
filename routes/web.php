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
Route::get('/install', function() {
	auth()->logout();
	Artisan::call('module:migrate', ['module' => "User"]);
	return "done";
});

Route::get('default', [
	'as' => 'web.home.default',
	'uses' => 'Website\IndexController@default',
]);

Route::get('/', [
	'as' => 'web.home',
	'uses' => 'Website\IndexController@index',
]);

Route::get('/tim-kiem', [
	'as' => 'web.search',
	'uses' => 'Website\SearchController@index',
]);

Route::get('edit', [
	'as' => 'web.edit',
	'uses' => 'Website\IndexController@edit',
]);

Route::get('login', [
	'as' => 'admin.login.index',
	'uses' => 'AppController@login',
]);
Route::get('tkadmin', [
	'as' => 'login',
	'uses' => 'Modules\User\Http\Controllers\Admin\AuthController@getLogin',
]);

Route::get('{link}', [
	'as' => 'web.link',
	'uses' => 'Website\LinkController@index',
]);