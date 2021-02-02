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

Route::prefix('questions')->group(function() {
	Route::get('/', [
		'as' => 'admin.questions.index',
		'uses' => 'QuestionController@index',
		'middleware' => 'can:admin.questions.index',
	]);
	Route::post('/', [
		'as' => 'admin.questions.index',
		'uses' => 'QuestionController@table',
		'middleware' => 'can:admin.questions.index',
	]);
	Route::get('create', [
		'as' => 'admin.questions.create',
		'uses' => 'QuestionController@create',
		'middleware' => 'can:admin.questions.create',
	]);

	Route::post('store', [
		'as' => 'admin.questions.store',
		'uses' => 'QuestionController@store',
		'middleware' => 'can:admin.questions.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'admin.questions.edit',
		'uses' => 'QuestionController@edit',
		'middleware' => 'can:admin.questions.edit',
	]);
	
	Route::post('update/{id}', [
		'as' => 'admin.questions.update',
		'uses' => 'QuestionController@update',
		'middleware' => 'can:admin.questions.edit',
	]);

	Route::post('status', [
		'as' => 'admin.questions.status',
		'uses' => 'QuestionController@status',
		'middleware' => 'can:admin.questions.create',
	]);

	Route::post('destroy', [
		'as' => 'admin.questions.destroy',
		'uses' => 'QuestionController@destroy',
		'middleware' => 'can:admin.questions.destroy',
	]);

	Route::get('{id}/show', [
		'as' => 'admin.questions.show',
		'uses' => 'QuestionController@show',
		'middleware' => 'can:admin.questions.show',
	]);
});