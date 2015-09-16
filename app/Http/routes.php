<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function() {
	return redirect('login');
});

Route::get('login', 'LoginController@index');
Route::get('register', 'RegisterController@index');

Route::group(['prefix' => 'roles'], function() {
	Route::get('{id}/selfsubmissions',	'RoleController@selfsubmissions');
	Route::get('{id}/likeitlist',		'RoleController@likeitlist');
	Route::get('{id}/matches',			'RoleController@matches');
});

Route::resource('projects'							, 'ProjectController');
Route::resource('projects.roles'					, 'RoleController', [ 'only' => [ 'edit', 'create' ] ]);
Route::resource('projects.schedules' 				, 'ScheduleController');

Route::get('talents'								, 'TalentController@index');
Route::get('talents/favorite'						, 'TalentController@favorite');
Route::resource('messages'							, 'MessageController');

Route::get('settings'								, 'ProfileController@settings');
