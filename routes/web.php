<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/boutiques/car/{id}/detail', 'BoutiqueController@carDetail')->name('boutiques.car.detail');
Route::get('/boutiques/car/{id}/propose-price', 'BoutiqueController@carDetail')->name('boutiques.car.propose.price');

Route::get('/boutique/car', 'BoutiqueController@getCar')->name('car.get');
Route::get('/boutique/car/data', 'BoutiqueController@getAllCar')->name('car.get.all');









Auth::routes(['verify' => true]);



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/admin', 'HomeController@admin')->name('admin');
    Route::get('/admin/all-users', 'UserController@index')->name('admin.all.users');
    Route::get('/admin/all-saler', 'UserController@index')->name('admin.all.saler');
    Route::get('/admin/all-customer', 'UserController@index')->name('admin.all.customer');
    Route::get('/admin/all-adminstrative', 'UserController@index')->name('admin.all.administative');
    Route::get('/admin/get-users', 'UserController@getAllUser')->name('admin.get.all.users');

    Route::get('/admin/saler-users', 'UserController@getAllSaler')->name('admin.get.all.saler');

    Route::get('/admin/customer', 'UserController@getAllCusomer')->name('admin.get.all.customer');

    Route::get('/admin/administratives', 'UserController@getAllAdminstrative')->name('admin.get.all.administratives');

    Route::post('/admin/user/create', 'UserController@store')->name('admin.user.create');
    Route::get('/admin/user/{id}/edit', 'UserController@edit')->name('admin.user.edit');
    Route::post('/admin/user/update/{id}', 'UserController@update')->name('admin.user.update');
    Route::post('/admin/user/delete/{id}', 'UserController@destroy')->name('admin.user.delete');


    Route::get('/admin/all-cars', 'CarController@index')->name('admin.all.cars');
    Route::get('/admin/all-getcars', 'CarController@getAllCar')->name('admin.get.all.cars');
    Route::get('/admin/all-get-car/{id}/edit', 'CarController@edit')->name('admin.get.car.edit');
    Route::post('/admin/car/create', 'CarController@store')->name('admin.car.create');
    Route::post('/admin/car/update/{id}', 'CarController@update')->name('admin.car.update');
    Route::post('/admin/car/delete/{id}', 'CarController@destroy')->name('admin.car.delete');
    Route::post('/admin/car/sold/upload/document', 'CarController@uploadDocument')->name('admin.car.sold.upload.document');

    Route::post('/order/create', 'OrderController@store')->name('order.create');
    Route::get('/order/edit/{id}', 'OrderController@edit')->name('

    ');
    Route::get('/order/success', function () {

        return view('pages.order.success', ['message' =>
        "Your order has been submited successfully, you will hear from us shortly"]);
    })->name('order.success');
    Route::get('/order/fail', function () {

        return view('pages.order.fail', ['message' =>
        "You already ordered this item, check in your order section, you will hear from us shortly"]);
    })->name('order.fail');


    Route::get('/seller/all-cars', 'CarController@index')->name('seller.all.cars');

    Route::post('/seller/car/create', 'CarController@store')->name('seller.car.create');
    Route::post('/seller/car/update/{id}', 'CarController@update')->name('seller.car.update');
    Route::post('/seller/car/delete/{id}', 'CarController@destroy')->name('seller.car.delete');

    //user route
    Route::get('/finance-management/orders', 'OrderController@index')->name('finance.management.orders');
    Route::get('/finance-management/get-orders', 'OrderController@getAllOrder')->name('finance.management.get.orders');
    Route::get('/order/payment/{id}/{type}', 'PaymentController@getOrderInfoForPayment')->name('finance.management.orders.payment');

    Route::get('/seller/all-cars', 'CarController@index')->name('seller.all.cars');

    Route::post('/seller/car/create', 'CarController@store')->name('seller.car.create');
    Route::post('/seller/car/update/{id}', 'CarController@update')->name('seller.car.update');
    Route::post('/seller/car/delete/{id}', 'CarController@destroy')->name('seller.car.delete');

    Route::post('/paymrent/order/address/{id}', 'PaymentController@create')->name('paymrent.order.address.create');
    Route::post('/order/aprove-cancel/{id}', 'OrderController@approveCancel')->name('order.approve.cancel');

    Route::post('/payment/create/{id}', 'PaymentController@store')->name('payment.store');

    Route::get('/finance-management/payment', 'PaymentController@index')->name('finance.management.payment');
    Route::get('/finance-management/payment/get-all-payment', 'PaymentController@getAllPayment')->name('finance.management.get.all.payment');
    Route::get('/finance-management/payment/get-payment/{id}/show', 'PaymentController@show')->name('finance.management.get.payment');
});
