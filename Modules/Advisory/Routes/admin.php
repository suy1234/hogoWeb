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

Route::prefix('advisorys')->group(function() {
	Route::get('/', [
		'as' => 'admin.advisorys.index',
		'uses' => 'AdvisoryController@index',
		'middleware' => 'can:admin.advisorys.index',
	]);
	Route::post('/', [
		'as' => 'admin.advisorys.index',
		'uses' => 'AdvisoryController@table',
		'middleware' => 'can:admin.advisorys.index',
	]);
	Route::get('create', [
		'as' => 'admin.advisorys.create',
		'uses' => 'AdvisoryController@create',
		'middleware' => 'can:admin.advisorys.create',
	]);

	Route::post('store', [
		'as' => 'admin.advisorys.store',
		'uses' => 'AdvisoryController@store',
		'middleware' => 'can:admin.advisorys.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'admin.advisorys.edit',
		'uses' => 'AdvisoryController@edit',
		'middleware' => 'can:admin.advisorys.edit',
	]);
	
	Route::post('update/{id}', [
		'as' => 'admin.advisorys.update',
		'uses' => 'AdvisoryController@update',
		'middleware' => 'can:admin.advisorys.edit',
	]);

	Route::post('status', [
		'as' => 'admin.advisorys.status',
		'uses' => 'AdvisoryController@status',
		'middleware' => 'can:admin.advisorys.create',
	]);

	Route::post('destroy', [
		'as' => 'admin.advisorys.destroy',
		'uses' => 'AdvisoryController@destroy',
		'middleware' => 'can:admin.advisorys.destroy',
	]);

	Route::get('{id}/show', [
		'as' => 'admin.advisorys.show',
		'uses' => 'AdvisoryController@show',
		'middleware' => 'can:admin.advisorys.show',
	]);
});