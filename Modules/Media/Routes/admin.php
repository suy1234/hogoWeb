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
	'as' => 'admin.medias.index',
	'uses' => 'MediaController@index',
]);
Route::post('/', [
	'as' => 'admin.medias.index',
	'uses' => 'MediaController@table',
]);
Route::get('create', [
	'as' => 'admin.medias.create',
	'uses' => 'MediaController@create',
]);

Route::post('store', [
	'as' => 'admin.medias.store',
	'uses' => 'MediaController@store',
]);

Route::get('edit/{id}', [
	'as' => 'admin.medias.edit',
	'uses' => 'MediaController@edit',
]);

Route::post('status', [
	'as' => 'admin.medias.status',
	'uses' => 'MediaController@status',
]);

Route::post('update/{id}', [
	'as' => 'admin.medias.update',
	'uses' => 'MediaController@update',
]);

Route::post('destroy', [
	'as' => 'admin.medias.destroy',
	'uses' => 'MediaController@destroy',
]);

Route::get('{id}/show', [
	'as' => 'admin.medias.show',
	'uses' => 'MediaController@show',
]);

Route::get('{id}/show', [
	'as' => 'admin.medias.show',
	'uses' => 'MediaController@show',
	'middleware' => 'can:admin.medias.show',
]);

Route::get('/medias/modal', [
	'as' => 'admin.medias.modal.index',
	'uses' => 'MediaController@modal',
]);