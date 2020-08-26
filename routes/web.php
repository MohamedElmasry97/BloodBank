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

Auth::routes();

Route::group(['middleware' => ['auth' , 'auto-check-permission']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('governorate', 'GovernorateController');
    Route::resource('governorate.city', 'CitiesController');
    Route::resource('category', 'CategoryController');
    Route::resource('category.post', 'PostController');
    Route::get('contact', 'ContactController@index');
    Route::delete('contact/{id}', 'ContactController@destroy');

    Route::get('donation', 'DonationController@index');
    Route::put('donation/{id}', 'DonationController@update');
    Route::delete('donation/{id}', 'DonationController@destroy');
    Route::get('donation/edit/{id}', 'DonationController@edit');
    Route::get('config/{id}', 'ConfigController@edit')->name('config');
    Route::post('config/{id}', 'ConfigController@update');
    Route::get('client', 'ClientController@index');
    Route::delete('client/{id}', 'ClientController@destroy');
    Route::get('reset_password', 'ResetAdminPasswordController@index');
    Route::put('reset_password', 'ResetAdminPasswordController@update');

    Route::resource('role', 'RoleController');
    Route::resource('user', 'UsersController');
});
