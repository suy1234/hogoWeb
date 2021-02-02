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
Route::prefix('widget-themes')->group(function() {
	Route::get('/', [
		'as' => 'admin.widget_themes.index',
		'uses' => 'WidgetThemeController@index',
		'middleware' => 'can:admin.widget_themes.index',
	]);
	Route::post('/', [
		'as' => 'admin.widget_themes.index',
		'uses' => 'WidgetThemeController@table',
		'middleware' => 'can:admin.widget_themes.index',
	]);
	Route::get('create', [
		'as' => 'admin.widget_themes.create',
		'uses' => 'WidgetThemeController@create',
		'middleware' => 'can:admin.widget_themes.create',
	]);

	Route::post('store', [
		'as' => 'admin.widget_themes.store',
		'uses' => 'WidgetThemeController@store',
		'middleware' => 'can:admin.widget_themes.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'admin.widget_themes.edit',
		'uses' => 'WidgetThemeController@edit',
		'middleware' => 'can:admin.widget_themes.edit',
	]);
	
	Route::post('update/{id}', [
		'as' => 'admin.widget_themes.update',
		'uses' => 'WidgetThemeController@update',
		'middleware' => 'can:admin.widget_themes.edit',
	]);

	Route::post('status', [
		'as' => 'admin.widget_themes.status',
		'uses' => 'WidgetThemeController@status',
		'middleware' => 'can:admin.widget_themes.create',
	]);

	Route::post('destroy', [
		'as' => 'admin.widget_themes.destroy',
		'uses' => 'WidgetThemeController@destroy',
		'middleware' => 'can:admin.widget_themes.destroy',
	]);

	Route::get('{id}/show', [
		'as' => 'admin.widget_themes.show',
		'uses' => 'WidgetThemeController@show',
		'middleware' => 'can:admin.widget_themes.show',
	]);
});