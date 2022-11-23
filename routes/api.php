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

Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {
    /**
     * register user
     */
    Route::post('/register', 'AuthController@register');

    /**
     * login user
     */
    Route::post('/login', 'AuthController@login');
});
Route::group(['namespace' => 'User'], function () {
    /**
     * shops
     */
    Route::get('/shops', 'ShopController@shops');
    Route::get('/shop/{id}/categories', 'ShopController@shopCategories');
    Route::get('/shop/{id}', 'ShopController@show');
    Route::get('/category_shops', 'ShopController@shopsByCategories');
    Route::get('/shop/{id}/products', 'ShopController@ShopProduct');


    /**
     * product
     */
    Route::get('/product/{id}', 'ProductController@getProduct');

    /**
     * searching
     */
    Route::get('/search/shop', 'ShopController@searchShop');
});




/**
 *
 * merchant
 */
Route::group(['prefix' => 'merchant', 'namespace' => 'Merchant'], function () {
    /**
     * register merchant
     */
    Route::post('/register', 'AuthController@register');

    /**
     * login merchant
     */
    Route::post('/login', 'AuthController@login');
});

Route::get('/category', 'Category\CategoryController@index');
Route::get('/category/{id}', 'Category\CategoryController@show');
