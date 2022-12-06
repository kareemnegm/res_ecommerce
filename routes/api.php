<?php

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\PasswordController;
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
Route::middleware('language')->group(function(){
    Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {
        /**
         * register user
         */
        Route::post('/register', [AuthController::class,'register']);

        /**
         * login user
         */
        Route::post('/login', [AuthController::class,'login']);

        Route::post('/forget-password', [PasswordController::class,'forgetPassword']);
        Route::post('/verify-code', [PasswordController::class,'verifyCode']);
        Route::post('/reset-password', [PasswordController::class,'resetPassword']);

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
        Route::get('/product_search/shop/{id}', 'ShopController@searchProductInShop');
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
    Route::apiResource('/country', 'CountryController');


    Route::get('payment_method', 'PaymentMethod\PaymentMethodController@PaymentMethods');
    Route::get('payment_method/{id}', 'PaymentMethod\PaymentMethodController@showPaymentMethod');

});
