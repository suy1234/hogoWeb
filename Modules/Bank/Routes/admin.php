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

Route::prefix('banks')->group(function() {
	Route::get('/', [
		'as' => 'admin.banks.index',
		'uses' => 'BankController@index',
		'middleware' => 'can:admin.banks.index',
	]);
	Route::post('/', [
		'as' => 'admin.banks.index',
		'uses' => 'BankController@table',
		'middleware' => 'can:admin.banks.index',
	]);
	Route::get('create', [
		'as' => 'admin.banks.create',
		'uses' => 'BankController@create',
		'middleware' => 'can:admin.banks.create',
	]);

	Route::post('store', [
		'as' => 'admin.banks.store',
		'uses' => 'BankController@store',
		'middleware' => 'can:admin.banks.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'admin.banks.edit',
		'uses' => 'BankController@edit',
		'middleware' => 'can:admin.banks.edit',
	]);
	
	Route::post('update/{id}', [
		'as' => 'admin.banks.update',
		'uses' => 'BankController@update',
		'middleware' => 'can:admin.banks.edit',
	]);

	Route::post('status', [
		'as' => 'admin.banks.status',
		'uses' => 'BankController@status',
		'middleware' => 'can:admin.banks.create',
	]);

	Route::post('destroy', [
		'as' => 'admin.banks.destroy',
		'uses' => 'BankController@destroy',
		'middleware' => 'can:admin.banks.destroy',
	]);

	Route::get('{id}/show', [
		'as' => 'admin.banks.show',
		'uses' => 'BankController@show',
		'middleware' => 'can:admin.banks.show',
	]);
});

Route::prefix('interest-rates')->group(function() {
	Route::get('/', [
		'as' => 'admin.interest_rates.index',
		'uses' => 'BankInterestRateController@index',
		'middleware' => 'can:admin.interest_rates.index',
	]);
	Route::post('/', [
		'as' => 'admin.interest_rates.index',
		'uses' => 'BankInterestRateController@table',
		'middleware' => 'can:admin.interest_rates.index',
	]);
	Route::get('create', [
		'as' => 'admin.interest_rates.create',
		'uses' => 'BankInterestRateController@create',
		'middleware' => 'can:admin.interest_rates.create',
	]);

	Route::post('store', [
		'as' => 'admin.interest_rates.store',
		'uses' => 'BankInterestRateController@store',
		'middleware' => 'can:admin.interest_rates.create',
	]);

	Route::get('edit/{id}', [
		'as' => 'admin.interest_rates.edit',
		'uses' => 'BankInterestRateController@edit',
		'middleware' => 'can:admin.interest_rates.edit',
	]);
	
	Route::post('update/{id}', [
		'as' => 'admin.interest_rates.update',
		'uses' => 'BankInterestRateController@update',
		'middleware' => 'can:admin.interest_rates.edit',
	]);

	Route::post('status', [
		'as' => 'admin.interest_rates.status',
		'uses' => 'BankInterestRateController@status',
		'middleware' => 'can:admin.interest_rates.create',
	]);

	Route::post('destroy', [
		'as' => 'admin.interest_rates.destroy',
		'uses' => 'BankInterestRateController@destroy',
		'middleware' => 'can:admin.interest_rates.destroy',
	]);

	Route::get('{id}/show', [
		'as' => 'admin.interest_rates.show',
		'uses' => 'BankInterestRateController@show',
		'middleware' => 'can:admin.interest_rates.show',
	]);
});