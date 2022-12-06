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


Route::middleware('language')->group(function(){
    Route::put('/change_password', 'AuthController@ChangePassword');
    Route::put('/edit', 'AuthController@update');
    Route::delete('/deactivate', 'AuthController@destroy');
    Route::post('/address', 'UserController@createAddress');
    Route::put('/address/{id}', 'UserController@updateAddress');
    Route::get('/addresses', 'UserController@myAddresses');



    Route::post('/cart', 'UserController@addProductsToCart')->middleware(['can:add-product-cart']);
    Route::post('/place_order', 'OrderController@placeOrder');
    Route::get('/cart', 'UserController@myCart')->middleware(['can:show-product-cart']);
    Route::delete('/cart/remove_product/{id}', 'UserController@removeProductFromCart')->middleware(['can:remove-product-cart']);
    Route::post('/favorite', 'UserController@addProductToFavorite')->middleware(['can:add-product-favorite']);
    Route::delete('/favorite/{id}', 'UserController@removeProductFromFavorite')->middleware(['can:remove-product-favorite']);
});
