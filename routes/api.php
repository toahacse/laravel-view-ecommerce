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

