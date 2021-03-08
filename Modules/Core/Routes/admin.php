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
Route::prefix('categorys/{code}')->group(function() {
	Route::get('', 'CategoryController@index')->name('admin.categorys.index');
	Route::post('', [
		'as' => 'admin.categorys.index',
		'uses' => 'CategoryController@table',
		'middleware' => 'can:admin.categorys.index',
	]);
	Route::get('create', [
		'as' => 'admin.categorys.create',
		'uses' => 'CategoryController@create',
		'middleware' => 'can:admin.categorys.create',
	]);

	Route::post('store', [
		'as' => 'admin.categorys.store',
		'uses' => 'CategoryController@store',
		'middleware' => 'can:admin.categorys.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'admin.categorys.edit',
		'uses' => 'CategoryController@edit',
		'middleware' => 'can:admin.categorys.edit',
	]);

	Route::post('update/{id}', [
		'as' => 'admin.categorys.update',
		'uses' => 'CategoryController@update',
		'middleware' => 'can:admin.categorys.edit',
	]);

	Route::post('status', [
		'as' => 'admin.categorys.status',
		'uses' => 'CategoryController@status',
		'middleware' => 'can:admin.categorys.create',
	]);

	Route::post('destroy', [
		'as' => 'admin.categorys.destroy',
		'uses' => 'CategoryController@destroy',
		'middleware' => 'can:admin.categorys.destroy',
	]);

	Route::get('{id}/show', [
		'as' => 'admin.categorys.show',
		'uses' => 'CategoryController@show',
		'middleware' => 'can:admin.categorys.show',
	]);
});

Route::prefix('groups/{code}')->group(function() {
	Route::get('', 'GroupController@index')->name('admin.groups.index');
	Route::post('', [
		'as' => 'admin.groups.index',
		'uses' => 'GroupController@table',
		'middleware' => 'can:admin.groups.index',
	]);
	Route::get('create', [
		'as' => 'admin.groups.create',
		'uses' => 'GroupController@create',
		'middleware' => 'can:admin.groups.create',
	]);

	Route::post('store', [
		'as' => 'admin.groups.store',
		'uses' => 'GroupController@store',
		'middleware' => 'can:admin.groups.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'admin.groups.edit',
		'uses' => 'GroupController@edit',
		'middleware' => 'can:admin.groups.edit',
	]);

	Route::post('update/{id}', [
		'as' => 'admin.groups.update',
		'uses' => 'GroupController@update',
		'middleware' => 'can:admin.groups.edit',
	]);

	Route::post('status', [
		'as' => 'admin.groups.status',
		'uses' => 'GroupController@status',
		'middleware' => 'can:admin.groups.create',
	]);

	Route::post('destroy', [
		'as' => 'admin.groups.destroy',
		'uses' => 'GroupController@destroy',
		'middleware' => 'can:admin.groups.destroy',
	]);

	Route::get('{id}/show', [
		'as' => 'admin.groups.show',
		'uses' => 'GroupController@show',
		'middleware' => 'can:admin.groups.show',
	]);
});
Route::prefix('group-type/{code}')->group(function() {
	Route::get('', 'GroupTypeController@index')->name('admin.group_types.index');
	Route::post('', [
		'as' => 'admin.group_types.index',
		'uses' => 'GroupTypeController@table',
		'middleware' => 'can:admin.group_types.index',
	]);
	Route::get('create', [
		'as' => 'admin.group_types.create',
		'uses' => 'GroupTypeController@create',
		'middleware' => 'can:admin.group_types.create',
	]);

	Route::post('store', [
		'as' => 'admin.group_types.store',
		'uses' => 'GroupTypeController@store',
		'middleware' => 'can:admin.group_types.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'admin.group_types.edit',
		'uses' => 'GroupTypeController@edit',
		'middleware' => 'can:admin.group_types.edit',
	]);

	Route::post('update/{id}', [
		'as' => 'admin.group_types.update',
		'uses' => 'GroupTypeController@update',
		'middleware' => 'can:admin.group_types.edit',
	]);

	Route::post('status', [
		'as' => 'admin.group_types.status',
		'uses' => 'GroupTypeController@status',
		'middleware' => 'can:admin.group_types.create',
	]);

	Route::post('destroy', [
		'as' => 'admin.group_types.destroy',
		'uses' => 'GroupTypeController@destroy',
		'middleware' => 'can:admin.group_types.destroy',
	]);

	Route::get('{id}/show', [
		'as' => 'admin.group_types.show',
		'uses' => 'GroupTypeController@show',
		'middleware' => 'can:admin.group_types.show',
	]);
});

Route::prefix('units/{code}')->group(function() {
	Route::get('', 'UnitController@index')->name('admin.units.index');
	Route::post('', [
		'as' => 'admin.units.index',
		'uses' => 'UnitController@table',
		'middleware' => 'can:admin.units.index',
	]);
	Route::get('create', [
		'as' => 'admin.units.create',
		'uses' => 'UnitController@create',
		'middleware' => 'can:admin.units.create',
	]);

	Route::post('store', [
		'as' => 'admin.units.store',
		'uses' => 'UnitController@store',
		'middleware' => 'can:admin.units.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'admin.units.edit',
		'uses' => 'UnitController@edit',
		'middleware' => 'can:admin.units.edit',
	]);

	Route::post('update/{id}', [
		'as' => 'admin.units.update',
		'uses' => 'UnitController@update',
		'middleware' => 'can:admin.units.edit',
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

	Route::get('{id}/show', [
		'as' => 'admin.units.show',
		'uses' => 'UnitController@show',
		'middleware' => 'can:admin.units.show',
	]);
});

Route::prefix('setting')->group(function() {
	Route::get('admin-app', [
		'as' => 'admin.settings.admin_app',
		'uses' => 'AdminAppController@adminApp',
	]);

	Route::post('admin-app', [
		'as' => 'admin.settings.admin_app',
		'uses' => 'AdminAppController@updateAdminApp',
	]);

	Route::get('package', [
		'as' => 'admin.settings.package',
		'uses' => 'PackageController@index',
	]);

	Route::post('package', [
		'as' => 'admin.settings.package',
		'uses' => 'PackageController@package',
	]);
});

// Route::prefix('attributes/{code}')->group(function() {
// 	Route::get('', 'AttributeController@index')->name('admin.attributes.index');
// 	Route::post('', [
// 		'as' => 'admin.attributes.index',
// 		'uses' => 'AttributeController@table',
// 		'middleware' => 'can:admin.attributes.index',
// 	]);
// 	Route::get('create', [
// 		'as' => 'admin.attributes.create',
// 		'uses' => 'AttributeController@create',
// 		'middleware' => 'can:admin.attributes.create',
// 	]);

// 	Route::post('store', [
// 		'as' => 'admin.attributes.store',
// 		'uses' => 'AttributeController@store',
// 		'middleware' => 'can:admin.attributes.create',
// 	]);

// 	Route::get('edit/{id}', [
// 		'as' => 'admin.attributes.edit',
// 		'uses' => 'AttributeController@edit',
// 		'middleware' => 'can:admin.attributes.edit',
// 	]);

// 	Route::post('update/{id}', [
// 		'as' => 'admin.attributes.update',
// 		'uses' => 'AttributeController@update',
// 		'middleware' => 'can:admin.attributes.edit',
// 	]);

// 	Route::post('status', [
// 		'as' => 'admin.attributes.status',
// 		'uses' => 'AttributeController@status',
// 		'middleware' => 'can:admin.attributes.create',
// 	]);

// 	Route::post('destroy', [
// 		'as' => 'admin.attributes.destroy',
// 		'uses' => 'AttributeController@destroy',
// 		'middleware' => 'can:admin.attributes.destroy',
// 	]);

// 	Route::get('{id}/show', [
// 		'as' => 'admin.attributes.show',
// 		'uses' => 'AttributeController@show',
// 		'middleware' => 'can:admin.attributes.show',
// 	]);
// });