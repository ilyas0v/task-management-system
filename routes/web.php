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

Route::group(['prefix' => 'admin' , 'middleware' => ['auth', 'role'] ], function(){

    Route::get('/',  'DashboardController@index')->name('dashboard.index');

    Route::resource('permissions',    'PermissionController');
    Route::resource('user_roles',     'UserRoleController');
    Route::resource('users',          'UserController');

    Route::get('projects/{id}/fetch_users',       'ProjectController@fetch_users')->name('projects.fetch_users');
    Route::post('projects/{id}/add_users',        'ProjectController@add_users')->name('projects.add_users');
    Route::resource('projects',                   'ProjectController');
    Route::resource('tasks',                      'TaskController');

});


Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout',   'Auth\LoginController@logout')->name('logout');

