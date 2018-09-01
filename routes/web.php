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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/calendar', 'CalendarController@index');

Route::resource('bookings', 'BookingController');
Route::get('/bookings/b/{boekert_id}', 'BookingController@editByBoekert');
Route::resource('customers', 'CustomerController');
Route::resource('accommodations', 'AccommodationController');

Auth::routes();
