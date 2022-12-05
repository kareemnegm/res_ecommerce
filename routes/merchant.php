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


Route::middleware('language')->group(function () {
    Route::apiResource('/category', 'MerchantCategoryController');
    Route::post('/shop', 'ShopController@createShop')->middleware(['can:create-shop']);
    Route::put('/shop/{id}', 'ShopController@updateShop')->middleware(['can:update-shop']);
    Route::post('/product', 'ProductController@store')->middleware(['can:property-show']);
    Route::get('/product', 'ProductController@index');
    Route::get('/product/{id}', 'ProductController@show')->middleware(['can:update-product']);
    Route::put('/product/{id}', 'ProductController@update');
    Route::delete('/product/{id}', 'ProductController@destroy')->middleware(['can:remove-product']);
    Route::post('product_variant', 'ProductController@productVariants')->middleware(['can:store-variant']);
    // Route::post('product_variant_combination','ProductController@productVariantCombination');
    // Route::put('product_variant_combination','ProductController@updateProductVariantCombination');
    // Route::get('product_variant_combination/{id}','ProductController@getProductVariantCombinations');
    Route::get('product_variant_values', 'ProductController@getProductVariantValues');
    Route::get('product/{id}/product_variants', 'ProductController@getProductVariant');

    Route::put('/change_password', 'AuthController@ChangePassword');
    Route::get('/profile', 'AuthController@myProfile');
    Route::put('/profile', 'AuthController@update');


    Route::post('/payment_method', 'ShopController@assignPaymentMethod');
    Route::get('/payment_method', 'ShopController@retrievePaymentMethods');
});
