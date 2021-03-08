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
// Route::prefix('widgets')->group(function() {
// 	Route::post('store', [
// 		'as' => 'admin.widgets.store',
// 		'uses' => 'WidgetController@store',
// 		'middleware' => 'can:admin.widgets.create',
// 	]);

// 	Route::post('update/{id}', [
// 		'as' => 'admin.widgets.update',
// 		'uses' => 'WidgetController@update',
// 		'middleware' => 'can:admin.widgets.edit',
// 	]);

// 	Route::post('destroy', [
// 		'as' => 'admin.widgets.destroy',
// 		'uses' => 'WidgetController@destroy',
// 		'middleware' => 'can:admin.widgets.destroy',
// 	]);
// });

Route::prefix('themes')->group(function() {
	Route::get('/', [
		'as' => 'admin.themes.index',
		'uses' => 'ThemeSettingController@index',
		'middleware' => 'can:admin.themes.index',
	]);
	
	Route::post('/', [
		'as' => 'admin.themes.index',
		'uses' => 'ThemeSettingController@table',
		'middleware' => 'can:admin.themes.index',
	]);

	Route::get('create', [
		'as' => 'admin.themes.create',
		'uses' => 'ThemeSettingController@create',
		'middleware' => 'can:admin.themes.create',
	]);

	Route::post('store', [
		'as' => 'admin.themes.store',
		'uses' => 'ThemeSettingController@store',
		'middleware' => 'can:admin.themes.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'admin.themes.edit',
		'uses' => 'ThemeSettingController@edit',
		'middleware' => 'can:admin.themes.edit',
	]);
	
	Route::post('update/{id}', [
		'as' => 'admin.themes.update',
		'uses' => 'ThemeSettingController@update',
		'middleware' => 'can:admin.themes.edit',
	]);

	Route::post('status', [
		'as' => 'admin.themes.status',
		'uses' => 'ThemeSettingController@status',
		'middleware' => 'can:admin.themes.status',
	]);

	Route::post('destroy', [
		'as' => 'admin.themes.destroy',
		'uses' => 'ThemeSettingController@destroy',
		'middleware' => 'can:admin.themes.destroy',
	]);
});

Route::prefix('menus')->group(function() {
	Route::get('/', [
		'as' => 'admin.menus.index',
		'uses' => 'MenuController@index',
		'middleware' => 'can:admin.menus.index',
	]);
	Route::post('store', [
		'as' => 'admin.menus.store',
		'uses' => 'MenuController@store',
		'middleware' => 'can:admin.menus.create',
	]);
	Route::post('store-menu', [
		'as' => 'admin.menus.store_menu',
		'uses' => 'MenuController@storeMenu',
		'middleware' => 'can:admin.menus.create',
	]);
	Route::post('delete', [
		'as' => 'admin.menus.delete',
		'uses' => 'MenuController@delete',
		'middleware' => 'can:admin.menus.create',
	]);
	Route::post('update', [
		'as' => 'admin.menus.update',
		'uses' => 'MenuController@updateMenu',
		'middleware' => 'can:admin.menus.create',
	]);

	Route::post('get-menu', [
		'as' => 'admin.menus.get',
		'uses' => 'MenuController@get',
		'middleware' => 'can:admin.menus.create',
	]);

	Route::post('get-list-menu', [
		'as' => 'admin.menus.get_list',
		'uses' => 'MenuController@getList',
		'middleware' => 'can:admin.menus.create',
	]);

	Route::post('get-data-package', [
		'as' => 'admin.menus.get_data_package',
		'uses' => 'MenuController@getDataPackage',
		'middleware' => 'can:admin.menus.index',
	]);
});
Route::prefix('pages')->group(function() {
	Route::get('/', [
		'as' => 'admin.pages.index',
		'uses' => 'PageController@index',
		'middleware' => 'can:admin.pages.index',
	]);
	Route::post('/', [
		'as' => 'admin.pages.index',
		'uses' => 'PageController@table',
		'middleware' => 'can:admin.pages.index',
	]);
	Route::get('create', [
		'as' => 'admin.pages.create',
		'uses' => 'PageController@create',
		'middleware' => 'can:admin.pages.create',
	]);

	Route::post('store', [
		'as' => 'admin.pages.store',
		'uses' => 'PageController@store',
		'middleware' => 'can:admin.pages.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'admin.pages.edit',
		'uses' => 'PageController@edit',
		'middleware' => 'can:admin.pages.edit',
	]);
	
	Route::post('update/{id}', [
		'as' => 'admin.pages.update',
		'uses' => 'PageController@update',
		'middleware' => 'can:admin.pages.edit',
	]);

	Route::post('status', [
		'as' => 'admin.pages.status',
		'uses' => 'PageController@status',
		'middleware' => 'can:admin.pages.create',
	]);

	Route::post('destroy', [
		'as' => 'admin.pages.destroy',
		'uses' => 'PageController@destroy',
		'middleware' => 'can:admin.pages.destroy',
	]);

	Route::get('{id}/show', [
		'as' => 'admin.pages.show',
		'uses' => 'PageController@show',
		'middleware' => 'can:admin.pages.show',
	]);

	Route::get('editor/{id}', [
		'as' => 'admin.pages.editor',
		'uses' => 'PageController@editor',
		'middleware' => 'can:admin.pages.editor',
	]);
	
	Route::post('editor/{id}', [
		'as' => 'admin.pages.editor_update',
		'uses' => 'PageController@editorUpdate',
		'middleware' => 'can:admin.pages.editor',
	]);

	Route::get('{id}/design', [
		'as' => 'admin.pages.design',
		'uses' => 'PageController@design',
		'middleware' => 'can:admin.pages.design',
	]);

	Route::post('build-data', [
		'as' => 'admin.pages.build',
		'uses' => 'PageController@build',
		'middleware' => 'can:admin.pages.design',
	]);

	Route::post('{id}/design/update', [
		'as' => 'admin.pages.design_store',
		'uses' => 'PageController@designStore',
		'middleware' => 'can:admin.pages.design',
	]);

	Route::post('pages/layouts', [
		'as' => 'admin.pages_layouts.list',
		'uses' => 'PageController@listLayouts',
		'middleware' => 'can:admin.pages.design',
	]);

	Route::post('pages/layouts/save', [
		'as' => 'admin.pages_layouts.save',
		'uses' => 'PageController@layoutSave',
		'middleware' => 'can:admin.pages.design',
	]);

	Route::post('pages/layouts/{id}/default', [
		'as' => 'admin.pages.layouts.default',
		'uses' => 'PageController@layoutDefault',
		'middleware' => 'can:admin.pages.design',
	]);
});

Route::prefix('posts')->group(function() {
	Route::get('/', [
		'as' => 'admin.posts.index',
		'uses' => 'PostController@index',
		'middleware' => 'can:admin.posts.index',
	]);
	Route::post('/', [
		'as' => 'admin.posts.index',
		'uses' => 'PostController@table',
		'middleware' => 'can:admin.posts.index',
	]);
	Route::get('create', [
		'as' => 'admin.posts.create',
		'uses' => 'PostController@create',
		'middleware' => 'can:admin.posts.create',
	]);

	Route::post('store', [
		'as' => 'admin.posts.store',
		'uses' => 'PostController@store',
		'middleware' => 'can:admin.posts.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'admin.posts.edit',
		'uses' => 'PostController@edit',
		'middleware' => 'can:admin.posts.edit',
	]);
	
	Route::post('update/{id}', [
		'as' => 'admin.posts.update',
		'uses' => 'PostController@update',
		'middleware' => 'can:admin.posts.edit',
	]);

	Route::post('status', [
		'as' => 'admin.posts.status',
		'uses' => 'PostController@status',
		'middleware' => 'can:admin.posts.create',
	]);

	Route::post('destroy', [
		'as' => 'admin.posts.destroy',
		'uses' => 'PostController@destroy',
		'middleware' => 'can:admin.posts.destroy',
	]);

	Route::get('{id}/show', [
		'as' => 'admin.posts.show',
		'uses' => 'PostController@show',
		'middleware' => 'can:admin.posts.show',
	]);
});

Route::prefix('layouts')->group(function() {
	Route::get('/', [
		'as' => 'admin.layouts.index',
		'uses' => 'LayoutController@index',
		'middleware' => 'can:admin.layouts.index',
	]);

	Route::post('/', [
		'as' => 'admin.layouts.index',
		'uses' => 'LayoutController@table',
		'middleware' => 'can:admin.layouts.index',
	]);

	Route::get('create', [
		'as' => 'admin.layouts.create',
		'uses' => 'LayoutController@create',
		'middleware' => 'can:admin.layouts.create',
	]);

	Route::post('store', [
		'as' => 'admin.layouts.store',
		'uses' => 'LayoutController@store',
		'middleware' => 'can:admin.layouts.create',
	]);

	Route::post('save-widget', [
		'as' => 'admin.layouts.save',
		'uses' => 'LayoutController@saveWidget',
		'middleware' => 'can:admin.layouts.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'admin.layouts.edit',
		'uses' => 'LayoutController@edit',
		'middleware' => 'can:admin.layouts.edit',
	]);
	
	Route::post('update/{id}', [
		'as' => 'admin.layouts.update',
		'uses' => 'LayoutController@update',
		'middleware' => 'can:admin.layouts.edit',
	]);

	Route::post('status', [
		'as' => 'admin.layouts.status',
		'uses' => 'LayoutController@status',
		'middleware' => 'can:admin.layouts.create',
	]);

	Route::post('list', [
		'as' => 'admin.layouts.list',
		'uses' => 'LayoutController@listLayouts',
		'middleware' => 'can:admin.layouts.create',
	]);

	Route::post('destroy', [
		'as' => 'admin.layouts.destroy',
		'uses' => 'LayoutController@destroy',
		'middleware' => 'can:admin.layouts.destroy',
	]);

	Route::get('{id}/design', [
		'as' => 'admin.layouts.design',
		'uses' => 'LayoutController@design',
		'middleware' => 'can:admin.layouts.design',
	]);

	Route::post('save-layout-theme', [
		'as' => 'admin.layouts.save_layout_theme',
		'uses' => 'LayoutController@saveLayout',
		'middleware' => 'can:admin.layouts.create',
	]);
});