<?php

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

Route::namespace('Auth')->group(function () {
    Route::post('login', 'LoginController@login')->name('login');
    Route::post('register', 'RegisterController@register')->name('register');
    Route::any('reset', 'ResetPasswordController@reset')->middleware('auth:api')->name('reset_password');
    Route::post('logout', 'LoginController@logout')->middleware('auth:api')->name('logout');
});

/**
 * Define router here which should be authenticated
 */
Route::group(['middleware' => ['auth:api']], function () {

});




