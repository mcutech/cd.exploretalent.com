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

Route::resource('projects'							, 'ProjectController');
Route::resource('projects.roles'					, 'ProjectRoleController'				,[ 'only' => [ 'edit', 'create' ] ]);
Route::resource('projects.roles.selfsubmissions' 	, 'ProjectRoleSelfSubmissionController'	,[ 'only' => [ 'index' ] ]);
Route::resource('projects.roles.likeitlist' 		, 'ProjectRoleLikeItListController'		,[ 'only' => [ 'index' ] ]);
Route::resource('projects.roles.matches' 			, 'ProjectRoleMatchController'			,[ 'only' => [ 'index' ] ]);
Route::resource('projects.schedules' 				, 'ProjectScheduleController');

Route::resource('talents'							, 'TalentController'					,[ 'only' => 'index' ]);
Route::resource('favoritetalents'					, 'FavoriteTalentController'			,[ 'only' => 'index' ]);

Route::resource('messages'							, 'MessageController'					,[ 'only' => 'index' ]);

Route::get('settings'								, 'ProfileController@settings');
