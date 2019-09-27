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

Route::get('', 'IndexController@register');
Route::post('', 'GuestController@store');

Route::get('dashboard', 'IndexController@dashboard');

Route::get('raffle', 'IndexController@raffle');

Route::get('fillup', 'IndexController@fillup');
Route::get('fillup/{id}', 'GuestController@edit');
Route::post('fillup/{id}', 'GuestController@update');

Route::get('validation/{ticket}', 'IndexController@validation');

Route::get('guests/{id}', 'GuestController@show');

Route::get('ticket/{ticket}', 'IndexController@guest_id');

Route::post('guests', 'GuestController@index');

Route::resource('guests', 'GuestController');