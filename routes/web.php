<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
    Author: Tan Jin Xian, Tan Ngiap Jun, Tan Chee Hua, Tan Yi Ying, Yap Kai Jean
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
    Route::get('/logout', 'Auth\staffLoginController@logout')->name('staff.logout');

    Route::prefix('/report')->group(function(){
        Route::get('/dailyOrderReport','reportController@showDailySaleReport')->name('manager.dailyReport');
        Route::get('/dailyPickupReport','reportController@showDailyPickupReport')->name('manager.dailyPickupReport');
        Route::get('/dailyDeliveryReport','reportController@showDailyDeliveryReport')->name('manager.dailyDeliveryReport');
    });

    Route::prefix('/payment')->group(function(){
        Route::post('/cancelOrder','paymentController@cancelOrder')->name('staff.payment.cancel');
        Route::post('/pay','paymentController@showPaymentForm')->name('staff.payment.form');
        Route::get('/payPickup','paymentController@showOrderPaymentPickup')->name('staff.payment.pickup');
        Route::get('/payDelivery','paymentController@showOrderPaymentDelivery')->name('staff.payment.delivery');
    });

    Route::resource('payment','paymentController');

    Route::get('/', 'StaffController@index')->name('staff.dashboard');
    
    //Route::get('/', 'paymentController@index')->name('staff.payment');
});

Route::prefix('customer')->group(function(){
    Route::get('custRegister','Auth\custRegisterController@showCustRegisterForm')->name('authenticationView.custRegister');
    Route::post('custRegister','Auth\custRegisterController@custRegister')->name('customer.register.submit');

    Route::get('custLogin','Auth\consumerLoginController@showLoginForm')->name('authenticationView.consumerLogin');
    Route::post('custLogin','Auth\consumerLoginController@login')->name('consumer.login.submit');


    Route::get('/','ConsumerController@index')->name('consumer.dashboard');
 
    //password resert for consumer
    Route::post('/password/email','Auth\ConsumerForgotPasswordController@sendResetLinkEmail')->name('consumer.password.email');
    Route::get('/password/reset','Auth\ConsumerForgotPasswordController@showLinkRequestForm')->name('consumer.password.request');
    Route::post('/password/reset','Auth\ConsumerResetPasswordController@reset');
    Route::get('/password/reset/{token}','Auth\ConsumerResetPasswordController@showResetForm')->name('consumer.password.reset');
    
}); 

//Route::get('/','reportController@index')->name('staff.report');