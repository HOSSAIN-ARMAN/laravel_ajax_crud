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
    return view('welcome');
});

Route::resource('posts', 'PostController');
Route::post('posts.store', 'PostController@store')->name('posts.store');
Route::get('posts.edit/{id?}', 'PostController@edit')->name('posts.edit');
Route::post('posts.delete', 'PostController@distroy')->name('posts.delete');
Route::get('posts.show', 'PostController@show')->name('posts.show');
Route::get('posts.display/{total?}', 'PostController@display')->name('posts.display');
Route::post('posts.search', 'PostController@search')->name('posts.search');
Route::get('posts.showByLaravel/{i?}', 'PostController@showByLaravel')->name('posts.showByLaravel');



Route::get('customer.show', 'CustomerController@show');
Route::get('customer.show/{id?}', 'CustomerController@get')->name('customer.show');



Route::get('division/{id?}', 'DivisionController@getCityBydivision')->name('division');
Route::get('division.city/{id?}/{division_id?}', 'DivisionController@getAreaByCity')->name('division.city');


