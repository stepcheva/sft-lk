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
Route::redirect('/', 'login', 301);

Route::get('login', 'AuthController@showLoginForm');
Route::post('login', 'AuthController@authenticate')->name('login');
Route::get('logout', 'AuthController@logout')->name('logout');

Route::get('home', 'UserController@index')->name('home');


Route::resource('users', 'UserController');
Route::resource('applicators', 'ApplicatorController');

//Route::group(['prefix' => 'admin', 'middleware' => 'isAdmin'], function () {

Route::group(['prefix' => 'user/{applicator}'], function () {
    Route::resource('applications', 'ApplicationController');
    Route::resource('contactquery', 'ContactqueryController');
    Route::get('productranges/{consigneer_id}', 'ApplicatorController@showProductranges')->name('productranges.list');

    //json на фронт
    Route::get('/consigneers', 'ApplicatorController@showConsigneers');
    Route::get('get/productranges/{consigneer_id}', 'ApplicatorController@getProducts');

});

Route::any('applications/{application}', 'ApplicationController@createProductVolume')->name('applications.product');
Route::post('applications/{application}/confirm', 'ApplicationController@confirmApplication')->name('applications.confirm');
Route::post('applications/{application}/send', 'ApplicationController@createOrder')->name('applications.send');
Route::any('applications/{application}/duplicate', 'ApplicationController@duplicate')->name('applications.duplicate');
Route::get('application/{application}/lunits', 'LunitsController@show')->name('shipments');

//Работа с файлами в отгрузках
Route::get('{lunit}/files', 'FileController@index');
Route::post('files/add/{lunit}', 'FileController@store');
Route::post('files/delete/{id}', 'FileController@destroy');

//Работа с транспортом  в отгрузках
Route::get('{lunit}/transports', 'LunitsController@getTransports');
Route::get('transports/edit/{id}', 'LunitsController@editTransports')->name('edit.transport');
Route::post('transports/add/{lunit}', 'LunitsController@addTransports')->name('add.user.transport');
Route::put('transports/{id}', 'LunitsController@updateTransports')->name('update.transport');

//работа с календарем
Route::get('{application}/calendar', 'ApplicationController@getCalendar')->name('applications.calendar');
Auth::routes();

/*
Route::group(['namespace' => 'Admin'], function () {
    Route::group(['prefix' => 'login'], function () {
        Route::post('/', 'AdminController@authenticate');
        Route::get('/', 'AdminController@showLoginForm')->name('login');
    });
    Route::post('logout', 'AdminController@logout')->name('logout');
});
*/

Route::get('/home', 'HomeController@index')->name('home');
