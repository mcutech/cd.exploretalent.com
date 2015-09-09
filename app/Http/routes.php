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

Route::resource('projects'                      , 'ProjectController');
Route::resource('projects.overview'             , 'ProjectOverviewController');
Route::resource('projects.selfsubmissions'      , 'ProjectSelfSubmissionsController');
Route::resource('projects.likeitlist'           , 'ProjectLikeItListController');
Route::resource('projects.likeitlistpublic'		, 'ProjectLikeItListPublicController');
Route::resource('projects.rolematches'          , 'ProjectRoleMatchesController');
Route::resource('projects.worksheets'           , 'ProjectWorksheetsController');
Route::resource('project.auditions'             , 'ProjectAuditionsController');

Route::resource('quickpost'                     , 'QuickPostController');

/** talents **/
Route::resource('talents'                       , 'TalentController');
Route::resource('favetalents'                   , 'FaveTalentController');

Route::resource('projects.jobs'                 , 'JobController');
Route::resource('settings'                      , 'SettingController');

/** schedule **/
Route::resource('schedules'                     , 'ScheduleController');
Route::resource('projects.schedules'            , 'ProjectSchedulesController');
Route::resource('projects.schedules.timeframes' , 'TimeframeController');
Route::resource('projects.schedules.auditions'  , 'AuditionController');

/** Conversation **/
Route::resource('conversations'                 , 'ConversationController');
Route::resource('conversations.messages'        , 'ConversationMessageController');
