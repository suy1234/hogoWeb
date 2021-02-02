<?php
Route::prefix('products')->group(function() {
	Route::get('/', [
		'as' => 'admin.products.index',
		'uses' => 'ProductController@index',
		'middleware' => 'can:admin.products.index',
	]);
	Route::post('/', [
		'as' => 'admin.products.index',
		'uses' => 'ProductController@table',
		'middleware' => 'can:admin.products.index',
	]);
	Route::get('create', [
		'as' => 'admin.products.create',
		'uses' => 'ProductController@create',
		'middleware' => 'can:admin.products.create',
	]);

	Route::post('store', [
		'as' => 'admin.products.store',
		'uses' => 'ProductController@store',
		'middleware' => 'can:admin.products.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'admin.products.edit',
		'uses' => 'ProductController@edit',
		'middleware' => 'can:admin.products.edit',
	]);
	
	Route::post('update/{id}', [
		'as' => 'admin.products.update',
		'uses' => 'ProductController@update',
		'middleware' => 'can:admin.products.edit',
	]);

	Route::post('status', [
		'as' => 'admin.products.status',
		'uses' => 'ProductController@status',
		'middleware' => 'can:admin.products.create',
	]);

	Route::post('destroy', [
		'as' => 'admin.products.destroy',
		'uses' => 'ProductController@destroy',
		'middleware' => 'can:admin.products.destroy',
	]);
});
Route::prefix('brands')->group(function() {
	Route::get('/', [
		'as' => 'admin.brands.index',
		'uses' => 'BrandController@index',
		'middleware' => 'can:admin.brands.index',
	]);
	Route::post('/', [
		'as' => 'admin.brands.index',
		'uses' => 'BrandController@table',
		'middleware' => 'can:admin.brands.index',
	]);
	Route::get('create', [
		'as' => 'admin.brands.create',
		'uses' => 'BrandController@create',
		'middleware' => 'can:admin.brands.create',
	]);

	Route::post('store', [
		'as' => 'admin.brands.store',
		'uses' => 'BrandController@store',
		'middleware' => 'can:admin.brands.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'admin.brands.edit',
		'uses' => 'BrandController@edit',
		'middleware' => 'can:admin.brands.edit',
	]);
	
	Route::post('update/{id}', [
		'as' => 'admin.brands.update',
		'uses' => 'BrandController@update',
		'middleware' => 'can:admin.brands.edit',
	]);

	Route::post('status', [
		'as' => 'admin.brands.status',
		'uses' => 'BrandController@status',
		'middleware' => 'can:admin.brands.create',
	]);

	Route::post('destroy', [
		'as' => 'admin.brands.destroy',
		'uses' => 'BrandController@destroy',
		'middleware' => 'can:admin.brands.destroy',
	]);
});
Route::prefix('units')->group(function() {
	Route::get('/', [
		'as' => 'admin.units.index',
		'uses' => 'UnitController@index',
		'middleware' => 'can:admin.units.index',
	]);

	Route::post('/', [
		'as' => 'admin.units.index',
		'uses' => 'UnitController@table',
		'middleware' => 'can:admin.units.index',
	]);

	Route::post('store', [
		'as' => 'admin.units.store',
		'uses' => 'UnitController@store',
		'middleware' => 'can:admin.units.index',
	]);
	
	Route::post('status', [
		'as' => 'admin.units.status',
		'uses' => 'UnitController@status',
		'middleware' => 'can:admin.units.create',
	]);

	Route::post('destroy', [
		'as' => 'admin.units.destroy',
		'uses' => 'UnitController@destroy',
		'middleware' => 'can:admin.units.destroy',
	]);
});

Route::prefix('attributes')->group(function() {
	Route::get('/', [
		'as' => 'admin.attributes.index',
		'uses' => 'AttributeController@index',
		'middleware' => 'can:admin.attributes.index',
	]);

	Route::post('/', [
		'as' => 'admin.attributes.index',
		'uses' => 'AttributeController@table',
		'middleware' => 'can:admin.attributes.index',
	]);

	Route::post('store', [
		'as' => 'admin.attributes.store',
		'uses' => 'AttributeController@store',
		'middleware' => 'can:admin.attributes.index',
	]);
	
	Route::post('status', [
		'as' => 'admin.attributes.status',
		'uses' => 'AttributeController@status',
		'middleware' => 'can:admin.attributes.create',
	]);

	Route::post('destroy', [
		'as' => 'admin.attributes.destroy',
		'uses' => 'AttributeController@destroy',
		'middleware' => 'can:admin.attributes.destroy',
	]);
});