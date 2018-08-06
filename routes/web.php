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

Route::get('/', function () {
    return view('pages.index');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('staff')->group(function(){
    Route::get('staffRegister','Auth\staffRegisterController@showStaffRegisterForm')->name('authenticationView.staffRegister');
    Route::post('staffRegister','Auth\staffRegisterController@staffRegister')->name('staff.register.submit');

    Route::get('staffLogin','Auth\staffLoginController@showLoginForm')->name('authenticationView.staffLogin');
    Route::post('staffLogin','Auth\staffLoginController@login')->name('staff.login.submit');

    Route::get('/', 'StaffController@index')->name('staff.dashboard');

    Route::get('/logout', 'Auth\staffLoginController@logout')->name('staff.logout');
});

