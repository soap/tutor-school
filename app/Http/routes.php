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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'User'], function() {
        Route::get('dashboard', 'DashboardController@index')->name('user.dashboard');
        Route::get('password/change', 'PasswordController@change')->name('user.password.change');
        Route::get('password/update', 'ProfileController@update')->name('user.password.update');
        Route::get('profile/edit', 'ProfileController@edit')->name('user.profile.edit');
        Route::patch('profile/update', 'ProfileController@update')->name('user.profile.update');
    });
});
