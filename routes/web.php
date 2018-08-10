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

/*
Route::get('/', function () {
    return view('pages.index');
});
*/


Route::get('/','Controller@userShow')->name('preprocess');
Route::get('/viewCat/{id}', 'Controller@showViewForConsumer')->name('view.cat');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('staff')->group(function(){
    Route::get('staffRegister','Auth\staffRegisterController@showStaffRegisterForm')->name('authenticationView.staffRegister');
    Route::post('staffRegister','Auth\staffRegisterController@staffRegister')->name('staff.register.submit');

    Route::get('staffLogin','Auth\staffLoginController@showLoginForm')->name('authenticationView.staffLogin');
    Route::post('staffLogin','Auth\staffLoginController@login')->name('staff.login.submit');
    Route::get('/logout', 'Auth\staffLoginController@logout')->name('staff.logout');

    Route::prefix('/report')->group(function(){
        Route::get('/dailyOrderReport/{r}','reportController@getClientReport')->name('manager.dailyReport');
        Route::get('/dailyPickupReport/{r}','reportController@getClientReport')->name('manager.dailyPickupReport');
        Route::get('/dailyDeliveryReport/{r}','reportController@getClientReport')->name('manager.dailyDeliveryReport');
    });

    Route::prefix('/creditLimit')->group(function(){
        Route::get('/chooseConsumer','staffController@showConsumer')->name('manager.chooseConsumer');
        Route::post('/chooseConsumer','staffController@updateCreditLimit')->name('manager.updateCredit');
        
    });
    
    
    Route::prefix('/invoice')->group(function(){
        Route::get('/selectConsumer','InvoiceController@showConsumer')->name('manager.CooperateConsumer');
        Route::post('/selectConsumer','InvoiceController@showInvoiceContent')->name('manager.invoiceDetail');
        Route::post('/InvoiceDetail','InvoiceController@storeInvoice')->name('manager.storeInvoice');
        Route::get('/printInvoice','InvoiceController@showPrintInvoice')->name('manager.showInvoice');
        Route::post('/Invoice','InvoiceController@DisplayInvoice')->name('manager.DisplayInvoice');
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

    Route::get('customerProfile','consumerProfileController@index')->name('consumer.profile');
    Route::post('customerProfile/{id}','consumerProfileController@update')->name('update.profile');
    Route::get('/','ConsumerController@index')->name('consumer.dashboard');
 
    //password resert for consumer
    Route::post('/password/email','Auth\ConsumerForgotPasswordController@sendResetLinkEmail')->name('consumer.password.email');
    Route::get('/password/reset','Auth\ConsumerForgotPasswordController@showLinkRequestForm')->name('consumer.password.request');
    Route::post('/password/reset','Auth\ConsumerResetPasswordController@reset');
    Route::get('/password/reset/{token}','Auth\ConsumerResetPasswordController@showResetForm')->name('consumer.password.reset');
    
}); 

//Route::get('/','reportController@index')->name('staff.report');

//product
Route::get('createProduct','productControl@creating')->name("creatingProduct");//use to call createproduct
Route::post('storeProduct','productControl@store')->name("CreateProduct");// use in createproduct
Route::get('generateXML',"productControl@generateXMLproduct")->name("createXML");//use to create XML file
Route::get('showAllProduct','productControl@index')->name("allProduct");//use for showing all product for delete or editing
Route::post('updateProduct',"productControl@updating")->name("updating");
Route::post('deletedItem',"productControl@destroyThem")->name("destroyingProduct");

Route::post('product/showall','productControl@showall');
Route::post('catalog/createMulti','catalogControl@createMulti');// in creating catalog
Route::post('catalog/update','catalogControl@update')->name("editCatalog");

Route::post('catalog/updateMonth','catalogControl@updateMonth')->name("updateMonth");//in editCatalog

Route::get('ShowAllCatalog','catalogControl@index')->name("showAllCatalog");
Route::get('showOnlyPromo/{id}','catalogControl@showPromo')->name("ShowPromotion");
Route::get('showOnlyFlower/{id}','catalogControl@ShowFlower')->name("ShowFlower");
Route::get('showOnlyBonquet/{id}','catalogControl@ShowBonquet')->name("ShowBonquet");
Route::get('showOnlyFloral/{id}','catalogControl@ShowFloral')->name("ShowFloral");



//go to starting page for partA
Route::get('showLinkage','productControl@jumpBackPartA')->name("showPartA");
//show linkage between part
Route::get('partA', function () {
    return view('Linking');
  });

Route::view('createCatalog','pages.CreateCatalog')->name("prepareCatalog");
Route::view('generateCatalog','xml.catalog')->name("shownXML");

Route::view('testXML','testXML');

Route::resource('product','productControl');
Route::resource('catalog','catalogControl');


//Tan Yi Ying
Route::get('orderMain', function() {
    if(Session::has('orderInfo'))
        Session::forget('orderInfo');
    if(Session::has('orderDetailList'))
        Session::forget('orderDetailList');
    if(Session::has('isEditable'))
        Session::forget('isEditable');
    if(Session::has('grandTotal'))
        Session::forget('grandTotal');
    if(Session::has('promoArray'))  
        Session::forget('promoArray');      
    
    return view('pages.order');
})->name('orderMain');

Route::post('orderIndex', 'OrderController@orderIndex');
Route::post('flowerOrder', 'OrderController@storeOrderDetails');
Route::post('deleteOrderItem/{productID}', 'OrderController@deleteOrderItem');
Route::post('updateOrderItem/{productID}', 'OrderController@updateOrderItem');
Route::post('storeOrderInfo', 'OrderController@storeOrderInfo');
Route::post('storeOrder', 'OrderController@storeOrder');
Route::post('displaySaleOrder', 'OrderController@displaySaleOrder');
Route::get('orderXML', 'OrderController@convertToXML');

Route::get('orderDetails', function () {
    return view('pages.orderDetails');
});

Route::get('proceedOrderInfo', function () {
    return view('pages.orderInfo');
});

Route::get('order', function() {
    return view('pages.order');
});

Route::get('orderConfirmation', function() {
    return view('pages.orderConfirmation');
});

Route::get('editOrderConfirmation', function() {
    $orderInfo = Session::get('orderInfo');
    Session::put('isEditable', true);
    return view('pages.orderConfirmation', compact('orderInfo'));
});

Route::get('saleOrder', function() {
    return view('pages.orderSale');
});