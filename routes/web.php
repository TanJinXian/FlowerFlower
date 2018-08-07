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

    Route::prefix('/report')->group(function(){
        Route::get('/dailyOrderReport','StaffController@showDailySaleReport')->name('manager.dailyReport');
        Route::get('/dailyPickupReport','StaffController@showDailyPickupReport')->name('manager.dailyPickupReport');
        Route::get('/dailyDeliveryReport','StaffController@showDailyDeliveryReport')->name('manager.dailyDeliveryReport');
    });
});

Route::prefix('customer')->group(function(){
    Route::get('custRegister','Auth\custRegisterController@showCustRegisterForm')->name('authenticationView.custRegister');
    Route::post('custRegister','Auth\custRegisterController@custRegister')->name('customer.register.submit');

    Route::get('custLogin','Auth\consumerLoginController@showLoginForm')->name('authenticationView.consumerLogin');
    Route::post('custLogin','Auth\consumerLoginController@login')->name('consumer.login.submit');


    Route::get('/','ConsumerController@index')->name('consumer.dashboard');
}); 

