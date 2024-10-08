<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Front\HomePageController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', function(Request $request) {
        return $request->user();
    });
    Route::post('/updateUser', [AuthController::class, 'updateUser']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);
});

Route::get('/getHeaderCategoriesData', [HomePageController::class, 'getHeaderCategoriesData']);
Route::get('/getHomeData', [HomePageController::class, 'getHomeData']);
Route::post('/getCategoryData', [HomePageController::class, 'getCategoryData']);
Route::get('/getProductData/{item_code?}/{slug?}', [HomePageController::class, 'getProductData']);
Route::post('/getUserData', [HomePageController::class, 'getUserData']);
Route::post('/getCartData', [HomePageController::class, 'getCartData']);
Route::post('/addToCart', [HomePageController::class, 'addToCart']);
Route::post('/removeCartData', [HomePageController::class, 'removeCartData']);
Route::post('/addCoupon', [HomePageController::class, 'addCoupon']);
Route::post('/getUserCoupon', [HomePageController::class, 'getUserCoupon']);
Route::post('/removeCoupon', [HomePageController::class, 'removeCoupon']);
Route::post('/getPincodeData', [HomePageController::class, 'getPincodeData']);
Route::post('/placeOrder', [HomePageController::class, 'placeOrder']);

