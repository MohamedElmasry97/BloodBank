<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {
    Route::get('governorates', 'MainController@governorates');
    Route::get('cities', 'MainController@cities');
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('reset_password', 'AuthController@ResetPassword');
    Route::post('new_password', 'AuthController@newPasswordSet');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('posts', 'MainController@posts');
        Route::get('post/{id}', 'MainController@postOne');
        Route::get('favourite', 'MainController@ListFavourite');
        Route::post('favourite/{id}', 'MainController@ToggleFavourite');
        Route::post('donation-request/create', 'MainController@dontationRequestCreate');
        Route::post('registertoken', 'AuthController@registerToken');
        Route::post('removetoken', 'AuthController@removeToken');
        Route::post('notification_setting', 'MainController@notificationSetting');
        Route::post('list_donation', 'MainController@listDonations');
        Route::get('donation/{id}', 'MainController@donateOne');
        Route::post('edit_client', 'MainController@editClient');
        Route::get('donation_read', 'MainController@donationRead');
        Route::post('settings', 'MainController@settings');
        Route::get('config', 'MainController@config');
    });
});
