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

Route::prefix('customers')->group(function() {
	Route::get('', 'CustomerController@index')->name('admin.customers.index');
	Route::post('', [
		'as' => 'admin.customers.index',
		'uses' => 'CustomerController@table',
		'middleware' => 'can:admin.customers.index',
	]);
	Route::get('create', [
		'as' => 'admin.customers.create',
		'uses' => 'CustomerController@create',
		'middleware' => 'can:admin.customers.create',
	]);

	Route::post('store', [
		'as' => 'admin.customers.store',
		'uses' => 'CustomerController@store',
		'middleware' => 'can:admin.customers.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'admin.customers.edit',
		'uses' => 'CustomerController@edit',
		'middleware' => 'can:admin.customers.edit',
	]);

	Route::post('update/{id}', [
		'as' => 'admin.customers.update',
		'uses' => 'CustomerController@update',
		'middleware' => 'can:admin.customers.edit',
	]);

	Route::post('status', [
		'as' => 'admin.customers.status',
		'uses' => 'CustomerController@status',
		'middleware' => 'can:admin.customers.create',
	]);

	Route::post('destroy', [
		'as' => 'admin.customers.destroy',
		'uses' => 'CustomerController@destroy',
		'middleware' => 'can:admin.customers.destroy',
	]);

	Route::get('{id}/show', [
		'as' => 'admin.customers.show',
		'uses' => 'CustomerController@show',
		'middleware' => 'can:admin.customers.show',
	]);
});
Route::prefix('students')->group(function() {
	Route::get('', 'StudentController@index')->name('admin.students.index');
	Route::post('', [
		'as' => 'admin.students.index',
		'uses' => 'StudentController@table',
		'middleware' => 'can:admin.students.index',
	]);
	Route::get('create', [
		'as' => 'admin.students.create',
		'uses' => 'StudentController@create',
		'middleware' => 'can:admin.students.create',
	]);

	Route::post('store', [
		'as' => 'admin.students.store',
		'uses' => 'StudentController@store',
		'middleware' => 'can:admin.students.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'admin.students.edit',
		'uses' => 'StudentController@edit',
		'middleware' => 'can:admin.students.edit',
	]);

	Route::post('update/{id}', [
		'as' => 'admin.students.update',
		'uses' => 'StudentController@update',
		'middleware' => 'can:admin.students.edit',
	]);

	Route::post('status', [
		'as' => 'admin.students.status',
		'uses' => 'StudentController@status',
		'middleware' => 'can:admin.students.create',
	]);

	Route::post('destroy', [
		'as' => 'admin.students.destroy',
		'uses' => 'StudentController@destroy',
		'middleware' => 'can:admin.students.destroy',
	]);

	Route::get('{id}/show', [
		'as' => 'admin.students.show',
		'uses' => 'StudentController@show',
		'middleware' => 'can:admin.students.show',
	]);
});
