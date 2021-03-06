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

Route::group(['prefix' => 'admin' , 'middleware' => ['auth', 'language'] ], function(){

    Route::get('/',  'DashboardController@index')->name('dashboard.index');

    Route::group(['middleware' => ['role']], function(){
        Route::resource('permissions',    'PermissionController');
        Route::resource('user_roles',     'UserRoleController');
        Route::resource('users',          'UserController');
    
        Route::get('projects/{id}/fetch_users',       'ProjectController@fetch_users')->name('projects.fetch_users');
        Route::post('projects/{id}/add_users',        'ProjectController@add_users')->name('projects.add_users');
        Route::resource('projects',                   'ProjectController')->middleware('project_attendance');
    
        Route::post('tasks/{id}/assign',              'TaskController@assign')->name('tasks.assign')->middleware('project_attendance');
        Route::post('tasks/{id}/comment',             'TaskController@comment')->name('tasks.comment')->middleware('project_attendance');
        Route::get('tasks/{id}/complete',             'TaskController@complete')->name('tasks.complete');
        Route::post('tasks/{id}/point',               'TaskController@give_point')->name('tasks.point');
        Route::resource('tasks',                      'TaskController')->middleware('project_attendance');
    });

    Route::get('/read-notification/{id}',         'NotificationController@read')->name('notifications.read')->middleware('auth');

    Route::get('/account/edit',                   'AccountController@edit')->name('account.edit');
    Route::put('/account/update',                 'AccountController@update')->name('account.update');
});


Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout',   'Auth\LoginController@logout')->name('logout');
 
Route::get('/gmail/login',     'GmailLoginController@redirect')->name('gmail.login');
Route::get('/gmail/callback',  'GmailLoginController@callback')->name('gmail.callback');


Route::get('test',          'UserController@test');


Route::get('change-lang/{locale}', 'LanguageController@change')->name('lang.change');
