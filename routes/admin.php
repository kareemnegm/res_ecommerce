<?php

use App\Http\Controllers\User\AuthController;
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
 * merchant
 */
Route::middleware('language')->group(function(){
    Route::post('/register', [AuthController::class, 'register'])->withoutMiddleware('auth:api');
    Route::post('/login', [AuthController::class, 'login'])->withoutMiddleware('auth:api');
    Route::apiResource('/category', 'Category\CategoryController');
    Route::apiResource('/payment_method', 'PaymentMethod\PaymentMethodController')->except(['update'])->middleware(['can:payment-methods-resource']);
    Route::put('/payment_method/{id}', 'PaymentMethod\PaymentMethodController@update')->middleware(['can:payment-method-update']);
    Route::get('/list_merchants', 'AdminController@listMerchants')->middleware(['can:list-merchants']);
    Route::put('/approve/merchant/{id}', 'AdminController@approveMerchant')->middleware(['can:approve-merchants']);
    Route::post('/merchant', 'AdminController@createMerchant')->middleware(['can:create-merchant']);
});
