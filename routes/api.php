<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ChangePasswordController;

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

Route::get('slides', [SlideController::class,'slide']);

Route::post('register', [SlideController::class, 'register']);
Route::post('login', [SlideController::class, 'login']);


// Google login
Route::get('google/{client_id}/{response_type}/{scope}/{redirect_uri}/{access_type}', [SlideController::class, 'redirectToGoogle'])->name('login.google');
Route::post('google/callback/{code}/{client_id}/{client_secret}/{redirect_uri}/{grant_type}', [SlideController::class, 'handleGoogleCallback']);

Route::get('google', [App\Http\Controllers\LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('google/callback', [App\Http\Controllers\LoginController::class, 'handleGoogleCallback']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('profile', [SlideController::class, 'profile']);
    Route::post('password', [ChangePasswordController::class, 'userpassword']);
    Route::post('add/wishlist', [SlideController::class, 'add_wishlist']);
    Route::get('wishlist', [SlideController::class, 'wishlist']);
    Route::post('cart', [SlideController::class, 'cart']);
    Route::get('list/cart', [SlideController::class, 'cart_list']);
    // Route::get('checkout', [SlideController::class, 'order_list']);
    Route::post('payment', [TransactionController::class, 'payment']);
    // Route::post('onlinepayment', [TransactionController::class, 'stripePost']);

    Route::get('downloadpdf', [TransactionController::class,'downloadSingleUser']);
    Route::get('downloadorder/{order_id}', [TransactionController::class,'downloadSingleOrder']);
    Route::post('logout', [SlideController::class, 'logout']);
});

Route::get('search/{name}', [SlideController::class, 'search']);
Route::post('sort', [SlideController::class, 'sort']);
Route::get('products', [ProductController::class, 'products']);


Route::post('onlinepayment', [TransactionController::class, 'paymentt']);
