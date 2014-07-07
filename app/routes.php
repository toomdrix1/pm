<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return Redirect::action('Toomdrix\\Pm\\DoorstepController@getIndex');
});

Route::group(array('before'=>array('auth','permission'),'namespace' => 'Toomdrix\Pm'), function() {
	Route::resource('dashboard', 'DashboardController');
	Route::resource('user', 'UserController');
	Route::resource('usergroup', 'UsergroupController');
	Route::resource('company', 'CompanyController');
	Route::resource('project', 'ProjectController');

	Route::resource('task', 'TaskController');
	Route::resource('milestone', 'MilestoneController');
	Route::resource('message', 'MessageController');
	Route::resource('file', 'FileController');
	Route::resource('time', 'TimeController');
});

Route::controller('doorstep', 'Toomdrix\\Pm\\DoorstepController');

View::composer('block.sidebar.project.list', 'Toomdrix\\Pm\\SidebarProjectListComposer');
View::composer('user.form', 'Toomdrix\\Pm\\UserCreateFormComposer');
View::composer('project.form', 'Toomdrix\\Pm\\ProjectCreateFormComposer');
View::composer('task.form', 'Toomdrix\\Pm\\TaskCreateFormComposer');