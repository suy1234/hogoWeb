<?php

// header('Access-Control-Allow-Origin: *');  
// header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
Route::prefix('exam')->group(function() {
	Route::post('group', [
		'as' => 'api.exam.group',
		'uses' => 'App\ExamController@getGroup',
	]);
	Route::post('exam', [
		'as' => 'api.exam.exam',
		'uses' => 'App\ExamController@getExam',
	]);

	Route::post('check-exam/{exam_id}', [
		'as' => 'api.exam.check',
		'uses' => 'Api\QuestionController@checkExam',
	]);
});
Route::prefix('student')->group(function() {
	Route::get('test', [
		'as' => 'api.student.test',
		'uses' => 'App\StudentController@test',
	]);
	Route::post('register', [
		'as' => 'api.student.register',
		'uses' => 'App\StudentController@register',
	]);
});

Route::get('/api-question', [
	'uses' => 'ApiController@index',
]);
Route::post('/convert-url', [
	'as' => 'convert.url',
	'uses' => 'ApiController@convertURL',
]);
Route::get('/api-answer', [
	'uses' => 'ApiController@Answer',
]);

Route::post('/api-form', [
	'as' => 'api.form',
	'uses' => 'FormController@form',
]);

Route::get('/install', function() {
	\Artisan::call('migrate',
		array(
			'--path' => 'Modules/User/Database/Migrations',
			'--force' => true
		)
	);
	return "done";
});

Route::prefix('theme')->group(function() {
	Route::post('/config', [
		'as' => 'api.theme.config',
		'uses' => 'Api\ThemeController@getConfig',
	]);
	Route::post('/save', [
		'as' => 'api.theme.save',
		'uses' => 'Api\ThemeController@save',
	]);
});
Route::prefix('theme')->group(function() {
	Route::post('/config', [
		'as' => 'api.theme.config',
		'uses' => 'Api\ThemeController@getConfig',
	]);
	Route::post('/save', [
		'as' => 'api.theme.save',
		'uses' => 'Api\ThemeController@save',
	]);
});

Route::prefix('layouts')->group(function() {
	Route::post('/', [
		'as' => 'api.layouts.get',
		'uses' => 'Api\LayoutController@get',
	]);
});


Route::post('/customer', [
	'as' => 'api.register.customer',
	'uses' => 'Api\CustomerController@register',
]);

Route::get('/clear', function() {

	\Artisan::call('cache:clear');
	\Artisan::call('config:clear');
	\Artisan::call('config:cache');
	\Artisan::call('view:clear');

	return "Cleared!";

});