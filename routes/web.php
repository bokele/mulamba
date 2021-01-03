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



Route::get('/services', function () {

    return view('pages.services',);
})->name('services');
Route::get('/pricing', function () {

    return view('pages.pricing',);
})->name('pricing');

Route::get('/about', function () {

    return view('pages.about',);
})->name('about');
Route::get('/contact', function () {

    return view('pages.contact',);
})->name('contact');





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
    Route::get('/order/edit/{id}', 'OrderController@edit')->name('');

    Route::get('/order/success', function () {

        return view('pages.order.success', ['message' =>
        "Your order has been submited successfully, you will hear from us shortly"]);
    })->name('order.success');
    Route::get('/order/fail', function () {

        return view('pages.order.fail', ['message' =>
        "You already ordered this item, check in your order section, you will hear from us shortly"]);
    })->name('order.fail');


    Route::get('/admin/plan', 'planController@index')->name('plan.index');
    Route::get('/admin/get-all-plan', 'planController@getAllPlan')->name('admin.get.all.plan');
    Route::get('/admin/edit/{id}', 'planController@edit')->name('admin.edit');
    Route::post('/admin/plan/store', 'planController@store')->name('plan.store');
    Route::post('/admin/plan/update/{id}', 'planController@update')->name('plan.update');
    Route::post('/admin/plan/delete/{id}', 'planController@destroy')->name('plan.destroy');

    Route::get('/admin/country', 'CountryController@index')->name('country.index');
    Route::get('/admin/get-all-country', 'CountryController@getAllCountry')->name('admin.get.all.country');
    Route::get('/admin/country/edit/{id}', 'CountryController@edit')->name('admin.country.edit');
    Route::post('/admin/country/store', 'CountryController@store')->name('country.store');
    Route::post('/admin/country/update/{id}', 'CountryController@update')->name('country.update');
    Route::post('/admin/country/delete/{id}', 'CountryController@destroy')->name('country.destroy');

    Route::get('/admin/gear-box', 'GearBoxTypeController@index')->name('gear.box.index');
    Route::get('/admin/get-all-gear-box', 'GearBoxTypeController@getAllGearBox')->name('admin.get.all.gear.box');
    Route::get('/admin/gear-box/edit/{id}', 'GearBoxTypeController@edit')->name('admin.gear-box.edit');
    Route::post('/admin/gear-box/store', 'GearBoxTypeController@store')->name('gear.box.store');
    Route::post('/admin/gear-box/update/{id}', 'GearBoxTypeController@update')->name('gear.box.update');
    Route::post('/admin/gear-box/delete/{id}', 'GearBoxTypeController@destroy')->name('gear.box.destroy');


    Route::get('/get-all-car-model-select', 'CarModelController@getAllCarModelSelect')->name('car.model.select');
    Route::get('/admin/car-model', 'CarModelController@index')->name('car.model.index');
    Route::get('/admin/get-all-car-model', 'CarModelController@getAllCarModel')->name('admin.get.all.car.model');
    Route::get('/admin/car-model/edit/{id}', 'CarModelController@edit')->name('admin.car.model.edit');
    Route::post('/admin/car-model/store', 'CarModelController@store')->name('car.model.store');
    Route::post('/admin/car-model/update/{id}', 'CarModelController@update')->name('car.model.update');
    Route::post('/admin/car-model/delete/{id}', 'CarModelController@destroy')->name('car.model.destroy');

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


    //booking
    Route::get('/boutiques/car/{id}/booking', 'ReservationController@index')->name('boutiques.car.booking');
    Route::post('/boutiques/car/booking/store', 'ReservationController@store')->name('boutiques.car.booking.store');
    Route::get('/payment/booking/{id}/{type}', 'ReservationController@bookingOrderInfo')->name('boutiques.car.booking.payment.info');
    Route::post('/payment/booking/{id}/create', 'PaymentController@create')->name('payment.booking.payment.create');


    Route::get('/user/profile', "UserController@index")->name('user.profile');
    Route::get('/user/profile/password', "UserController@index")->name('user.profile.change.password');
    Route::get('/user/profile/picture', "UserController@index")->name('user.profile.change.picture');
    Route::post('/user/profile/general-setting', "UserController@update")->name('user.profile.general.setting');
    Route::post('/user/profile/change/password', "UserController@updatePassword")->name('user.profile.password');
    Route::post('/user/profile/change/picture', "UserController@updateProfilePicture")->name('user.profile.picture');
});
