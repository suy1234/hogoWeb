<?php

Route::prefix('educations')->group(function() {
	Route::prefix('subjects')->group(function() {
		Route::get('/', [
			'as' => 'admin.subjects.index',
			'uses' => 'SubjectController@index',
			'middleware' => 'can:admin.subjects.index',
		]);
		Route::post('/', [
			'as' => 'admin.subjects.index',
			'uses' => 'SubjectController@table',
			'middleware' => 'can:admin.subjects.index',
		]);
		Route::get('create', [
			'as' => 'admin.subjects.create',
			'uses' => 'SubjectController@create',
			'middleware' => 'can:admin.subjects.create',
		]);

		Route::post('store', [
			'as' => 'admin.subjects.store',
			'uses' => 'SubjectController@store',
			'middleware' => 'can:admin.subjects.create',
		]);

		Route::get('edit/{id}', [
			'as' => 'admin.subjects.edit',
			'uses' => 'SubjectController@edit',
			'middleware' => 'can:admin.subjects.edit',
		]);

		Route::post('update/{id}', [
			'as' => 'admin.subjects.update',
			'uses' => 'SubjectController@update',
			'middleware' => 'can:admin.subjects.edit',
		]);

		Route::post('status', [
			'as' => 'admin.subjects.status',
			'uses' => 'SubjectController@status',
			'middleware' => 'can:admin.subjects.create',
		]);

		Route::post('destroy', [
			'as' => 'admin.subjects.destroy',
			'uses' => 'SubjectController@destroy',
			'middleware' => 'can:admin.subjects.destroy',
		]);

		Route::get('{id}/show', [
			'as' => 'admin.subjects.show',
			'uses' => 'SubjectController@show',
			'middleware' => 'can:admin.subjects.show',
		]);
	});

	Route::prefix('courses')->group(function() {
		Route::get('/', [
			'as' => 'admin.courses.index',
			'uses' => 'CourseController@index',
			'middleware' => 'can:admin.courses.index',
		]);
		Route::post('/', [
			'as' => 'admin.courses.index',
			'uses' => 'CourseController@table',
			'middleware' => 'can:admin.courses.index',
		]);
		Route::get('create', [
			'as' => 'admin.courses.create',
			'uses' => 'CourseController@create',
			'middleware' => 'can:admin.courses.create',
		]);

		Route::post('store', [
			'as' => 'admin.courses.store',
			'uses' => 'CourseController@store',
			'middleware' => 'can:admin.courses.create',
		]);

		Route::get('edit/{id}', [
			'as' => 'admin.courses.edit',
			'uses' => 'CourseController@edit',
			'middleware' => 'can:admin.courses.edit',
		]);
		
		Route::post('update/{id}', [
			'as' => 'admin.courses.update',
			'uses' => 'CourseController@update',
			'middleware' => 'can:admin.courses.edit',
		]);

		Route::post('status', [
			'as' => 'admin.courses.status',
			'uses' => 'CourseController@status',
			'middleware' => 'can:admin.courses.create',
		]);

		Route::post('destroy', [
			'as' => 'admin.courses.destroy',
			'uses' => 'CourseController@destroy',
			'middleware' => 'can:admin.courses.destroy',
		]);

		Route::get('{id}/show', [
			'as' => 'admin.courses.show',
			'uses' => 'CourseController@show',
			'middleware' => 'can:admin.courses.show',
		]);
	});

	Route::prefix('schedules')->group(function() {
		Route::get('/', [
			'as' => 'admin.schedules.index',
			'uses' => 'ScheduleController@index',
			'middleware' => 'can:admin.schedules.index',
		]);
		Route::post('/', [
			'as' => 'admin.schedules.index',
			'uses' => 'ScheduleController@table',
			'middleware' => 'can:admin.schedules.index',
		]);
		Route::get('create', [
			'as' => 'admin.schedules.create',
			'uses' => 'ScheduleController@create',
			'middleware' => 'can:admin.schedules.create',
		]);

		Route::post('store', [
			'as' => 'admin.schedules.store',
			'uses' => 'ScheduleController@store',
			'middleware' => 'can:admin.schedules.create',
		]);

		Route::get('edit/{id}', [
			'as' => 'admin.schedules.edit',
			'uses' => 'ScheduleController@edit',
			'middleware' => 'can:admin.schedules.edit',
		]);

		Route::post('update/{id}', [
			'as' => 'admin.schedules.update',
			'uses' => 'ScheduleController@update',
			'middleware' => 'can:admin.schedules.edit',
		]);

		Route::post('status', [
			'as' => 'admin.schedules.status',
			'uses' => 'ScheduleController@status',
			'middleware' => 'can:admin.schedules.create',
		]);

		Route::post('destroy', [
			'as' => 'admin.schedules.destroy',
			'uses' => 'ScheduleController@destroy',
			'middleware' => 'can:admin.schedules.destroy',
		]);

		Route::get('{id}/show', [
			'as' => 'admin.schedules.show',
			'uses' => 'ScheduleController@show',
			'middleware' => 'can:admin.schedules.show',
		]);
	});

	Route::prefix('checkins')->group(function() {
		Route::get('/', [
			'as' => 'admin.checkins.index',
			'uses' => 'CheckinController@index',
			'middleware' => 'can:admin.checkins.index',
		]);
		Route::post('/', [
			'as' => 'admin.checkins.index',
			'uses' => 'CheckinController@table',
			'middleware' => 'can:admin.checkins.index',
		]);

		Route::post('status', [
			'as' => 'admin.checkins.status',
			'uses' => 'CheckinController@status',
			'middleware' => 'can:admin.checkins.create',
		]);

		Route::post('destroy', [
			'as' => 'admin.checkins.destroy',
			'uses' => 'CheckinController@destroy',
			'middleware' => 'can:admin.checkins.destroy',
		]);
	});

	Route::prefix('classs')->group(function() {
		Route::get('/', [
			'as' => 'admin.classs.index',
			'uses' => 'ClassController@index',
			'middleware' => 'can:admin.classs.index',
		]);
		Route::post('/', [
			'as' => 'admin.classs.index',
			'uses' => 'ClassController@table',
			'middleware' => 'can:admin.classs.index',
		]);
		Route::get('create', [
			'as' => 'admin.classs.create',
			'uses' => 'ClassController@create',
			'middleware' => 'can:admin.classs.create',
		]);

		Route::post('store', [
			'as' => 'admin.classs.store',
			'uses' => 'ClassController@store',
			'middleware' => 'can:admin.classs.create',
		]);

		Route::get('edit/{id}', [
			'as' => 'admin.classs.edit',
			'uses' => 'ClassController@edit',
			'middleware' => 'can:admin.classs.edit',
		]);

		Route::post('update/{id}', [
			'as' => 'admin.classs.update',
			'uses' => 'ClassController@update',
			'middleware' => 'can:admin.classs.edit',
		]);

		Route::post('status', [
			'as' => 'admin.classs.status',
			'uses' => 'ClassController@status',
			'middleware' => 'can:admin.classs.create',
		]);

		Route::post('destroy', [
			'as' => 'admin.classs.destroy',
			'uses' => 'ClassController@destroy',
			'middleware' => 'can:admin.classs.destroy',
		]);

		Route::get('{id}/show', [
			'as' => 'admin.classs.show',
			'uses' => 'ClassController@show',
			'middleware' => 'can:admin.classs.show',
		]);

		Route::post('subject-cal', [
			'as' => 'admin.classs.subject',
			'uses' => 'ClassController@subject',
		]);
	});
});