<?php
Route::prefix('real_estates')->group(function() {
	Route::get('/', [
		'as' => 'admin.real_estates.index',
		'uses' => 'ProductController@index',
		'middleware' => 'can:admin.real_estates.index',
	]);
	Route::post('/', [
		'as' => 'admin.real_estates.index',
		'uses' => 'ProductController@table',
		'middleware' => 'can:admin.real_estates.index',
	]);
	Route::get('create', [
		'as' => 'admin.real_estates.create',
		'uses' => 'ProductController@create',
		'middleware' => 'can:admin.real_estates.create',
	]);

	Route::post('store', [
		'as' => 'admin.real_estates.store',
		'uses' => 'ProductController@store',
		'middleware' => 'can:admin.real_estates.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'admin.real_estates.edit',
		'uses' => 'ProductController@edit',
		'middleware' => 'can:admin.real_estates.edit',
	]);
	
	Route::post('update/{id}', [
		'as' => 'admin.real_estates.update',
		'uses' => 'ProductController@update',
		'middleware' => 'can:admin.real_estates.edit',
	]);

	Route::post('status', [
		'as' => 'admin.real_estates.status',
		'uses' => 'ProductController@status',
		'middleware' => 'can:admin.real_estates.create',
	]);

	Route::post('destroy', [
		'as' => 'admin.real_estates.destroy',
		'uses' => 'ProductController@destroy',
		'middleware' => 'can:admin.real_estates.destroy',
	]);
});