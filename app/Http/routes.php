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

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => 'auth'], function () {
    Route::resource('students', 'StudentController');
    Route::get('api/students', 'StudentController@getDataTable')->name('api.students');

    Route::group(['namespace' => 'Auth'], function() {
        Route::get('password/change', 'PasswordController@showChangePasswordForm')->name('auth.password.change');
        Route::post('password/update', 'PasswordController@changePassword')->name('auth.password.update');
    });

    Route::group(['namespace' => 'User'], function() {
        Route::get('dashboard', 'DashboardController@index')->name('user.dashboard');
        Route::get('profile', 'ProfileController@index')->name('user.profile');
        Route::get('profile/edit', 'ProfileController@edit')->name('user.profile.edit');
        Route::patch('profile/update', 'ProfileController@update')->name('user.profile.update');
    });
});


Route::group(['prefix'=>'api/v1', 'middleware'=>'auth:api'], function() {

});