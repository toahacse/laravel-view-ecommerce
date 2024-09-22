<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomeBannerController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function() {
    return view('admin/index');
});

// profile Route
Route::get('profile', [ProfileController::class, 'index']);
Route::post('saveProfile', [ProfileController::class, 'saveProfile']);

//home banner route
Route::get('home-banner', [HomeBannerController::class, 'index']);
Route::post('updateHomeBanner', [HomeBannerController::class, 'store']);

//manage-size route
Route::get('manage-size', [SizeController::class, 'index']);
Route::post('updateSize', [SizeController::class, 'store']);

//manage-color route
Route::get('manage-color', [ColorController::class, 'index']);
Route::post('updateColor', [ColorController::class, 'store']);

//delete Data
Route::get('deleteData/{id?}/{table?}', [DashboardController::class, 'deleteData']);