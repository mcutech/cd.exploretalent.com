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

Route::get('/', 'LoginController@index');
Route::get('login', 'LoginController@index');
Route::get('register', 'RegisterController@index');
Route::get('forgot-password', 'ForgotPasswordController@index');
Route::get('reset-password', 'ResetPasswordController@index');
Route::get('unsubscribe', 'UnsubscribeController@index');

Route::get('projects/quickpost', 'ProjectController@quickpost');
Route::get('projects/{projectId}/worksheet', 'ProjectController@worksheet');
Route::get('projects/{projectId}/roles/{roleId}/worksheet', 'RoleController@worksheet');
Route::get('projects/{projectId}/roles/{roleId}/submissions', 'RoleController@submissions');
Route::get('projects/{projectId}/roles/{roleId}/like-it-list', 'RoleController@likeitlist');
Route::get('projects/{projectId}/roles/{roleId}/find-talents', 'RoleController@findtalents');
Route::get('projects/{projectId}/roles/{roleId}/public-like-it-list', 'RoleController@publiclikeitlist');
Route::get('projects/{projectId}/roles/{roleId}/public-like-it-list/{accessToken}', 'RoleController@publiclikeitlist');
Route::get('projects/{projectId}/roles/{roleId}/callbacks', 'RoleController@callbacks');
Route::get('projects/{projectId}/roles/{roleId}/booked', 'RoleController@booked');
Route::get('projects/{projectId}/roles/{roleId}/landing', 'RoleController@landing');
Route::resource('projects', 'ProjectController');
Route::resource('projects.roles', 'RoleController');
Route::resource('projects.schedules', 'ScheduleController');

Route::get('talents', 'TalentController@index');
Route::get('talents/favorite', 'TalentController@favorite');
Route::get('talents/{talentId}', 'TalentController@talentresume');
Route::get('settings', 'ProfileController@settings');
Route::get('welcome', 'WelcomeController@index');
Route::get('error', 'ErrorController@index');
Route::resource('feedback', 'FeedbackController');

// Disabled routes...
/* Route::get('messages/{projectId}/{roleId}' , 'MessageController@index'); */
/* Route::get('messages/{projectId}'          , 'MessageController@index'); */
/* Route::get('messages', 'MessageController@index'); */
