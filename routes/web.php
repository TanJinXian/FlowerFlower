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

Route::get('staffRegister','AuthController@showStaffRegisterForm')->name('authenticationView.staffRegister');
Route::post('staffRegister','AuthController@staffRegister');

Route::get('staffLogin','AuthController@showStaffLoginForm')->name('authenticationView.staffLogin');
Route::post('staffLogin','AuthController@staffLogin');
