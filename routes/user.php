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

Route::put('/change_password', 'AuthController@ChangePassword');
Route::put('/edit', 'AuthController@update');
Route::delete('/deactivate', 'AuthController@destroy');
Route::post('/address', 'UserController@createAddress');
Route::put('/address/{id}', 'UserController@updateAddress');
Route::get('/addresses', 'UserController@myAddresses');

Route::post('/cart', 'UserController@addProductsToCart');
Route::delete('/cart/remove_product/{id}', 'UserController@removeProductFromCart');
Route::post('/favorite', 'UserController@addProductToFavorite');
Route::delete('/favorite/{id}', 'UserController@removeProductFromFavorite');
