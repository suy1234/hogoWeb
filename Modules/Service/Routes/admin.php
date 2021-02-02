<?php
Route::prefix('services')->group(function() {
	Route::get('/', [
		'as' => 'admin.services.index',
		'uses' => 'ProductController@index',
		'middleware' => 'can:admin.services.index',
	]);
	Route::post('/', [
		'as' => 'admin.services.index',
		'uses' => 'ProductController@table',
		'middleware' => 'can:admin.services.index',
	]);
	Route::get('create', [
		'as' => 'admin.services.create',
		'uses' => 'ProductController@create',
		'middleware' => 'can:admin.services.create',
	]);

	Route::post('store', [
		'as' => 'admin.services.store',
		'uses' => 'ProductController@store',
		'middleware' => 'can:admin.services.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'admin.services.edit',
		'uses' => 'ProductController@edit',
		'middleware' => 'can:admin.services.edit',
	]);
	
	Route::post('update/{id}', [
		'as' => 'admin.services.update',
		'uses' => 'ProductController@update',
		'middleware' => 'can:admin.services.edit',
	]);

	Route::post('status', [
		'as' => 'admin.services.status',
		'uses' => 'ProductController@status',
		'middleware' => 'can:admin.services.create',
	]);

	Route::post('destroy', [
		'as' => 'admin.services.destroy',
		'uses' => 'ProductController@destroy',
		'middleware' => 'can:admin.services.destroy',
	]);

	Route::get('{id}/show', [
		'as' => 'admin.services.show',
		'uses' => 'ProductController@show',
		'middleware' => 'can:admin.services.show',
	]);
});