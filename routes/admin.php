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



/**
 *
 * merchant
 */
Route::middleware(['language'])->group(function(){
    Route::group(['middleware' => ['role:admin']], function () {
        Route::apiResource('/category', 'Category\CategoryController');
        Route::apiResource('/payment_method', 'PaymentMethod\PaymentMethodController')->except(['update']);
        Route::put('/payment_method/{id}', 'PaymentMethod\PaymentMethodController@update');
        Route::get('/list_merchants', 'AdminController@listMerchants');
        Route::put('/approve/merchant/{id}', 'AdminController@approveMerchant');
        Route::post('/merchant', 'AdminController@createMerchant');
});
   
});