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

Route::resource('users', 'UserController');
Route::resource('applicators', 'ApplicatorController');

//Route::group(['prefix' => 'admin', 'middleware' => 'isAdmin'], function () {

Route::group(['prefix' => '{applicator}'], function () {
    Route::resource('applications', 'ApplicationController');
});

Route::post('applications/{application}', 'ApplicationController@createProductVolume')->name('applications.product');
Route::post('applications/{application}/confirm', 'ApplicationController@confirmApplication')->name('applications.confirm');

Route::post('applications/{application}/send', 'ApplicationController@createOrder')->name('applications.send');
