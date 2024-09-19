<?php

use App\Http\Controllers\Admin\HomeBannerController;
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