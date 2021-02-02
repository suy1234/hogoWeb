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

Route::get('/', [
	'as' => 'admin.langs.index',
	'uses' => 'LangController@index',
	'middleware' => 'can:admin.langs.index',
]);
Route::post('/', [
	'as' => 'admin.langs.index',
	'uses' => 'LangController@table',
	'middleware' => 'can:admin.langs.index',
]);
Route::get('create', [
	'as' => 'admin.langs.create',
	'uses' => 'LangController@create',
	'middleware' => 'can:admin.langs.create',
]);

Route::post('store', [
	'as' => 'admin.langs.store',
	'uses' => 'LangController@store',
	'middleware' => 'can:admin.langs.create',
]);

Route::get('edit/{id}', [
	'as' => 'admin.langs.edit',
	'uses' => 'LangController@edit',
	'middleware' => 'can:admin.langs.edit',
]);

Route::post('status', [
	'as' => 'admin.langs.status',
	'uses' => 'LangController@status',
	'middleware' => 'can:admin.langs.create',
]);

Route::post('update/{id}', [
	'as' => 'admin.langs.update',
	'uses' => 'LangController@update',
	'middleware' => 'can:admin.langs.edit',
]);

Route::post('destroy', [
	'as' => 'admin.langs.destroy',
	'uses' => 'LangController@destroy',
	'middleware' => 'can:admin.langs.destroy',
]);

Route::get('{id}/show', [
	'as' => 'admin.langs.show',
	'uses' => 'LangController@show',
	'middleware' => 'can:admin.langs.show',
]);