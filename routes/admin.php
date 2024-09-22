<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomeBannerController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\AttributeController;
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

//manage-attribute route
Route::get('attribute-name', [AttributeController::class, 'index_attribute_name']);
Route::post('updateAttributeName', [AttributeController::class, 'store_attribute_name']);
Route::get('attribute-value', [AttributeController::class, 'index_attribute_value']);
Route::post('updateAttributeValue', [AttributeController::class, 'store_attribute_value']);

//delete Data
Route::get('deleteData/{id?}/{table?}', [DashboardController::class, 'deleteData']);