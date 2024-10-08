<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomeBannerController;

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

//manage-Coupon route
Route::get('manage-coupon', [CouponController::class, 'index']);
Route::post('updateCoupon', [CouponController::class, 'store']);

//manage-attribute route
Route::get('attribute-name', [AttributeController::class, 'index_attribute_name']);
Route::post('updateAttributeName', [AttributeController::class, 'store_attribute_name']);

Route::get('attribute-value', [AttributeController::class, 'index_attribute_value']);
Route::post('updateAttributeValue', [AttributeController::class, 'store_attribute_value']);

//manage-color route
Route::get('category', [CategoryController::class, 'index']);
Route::post('updateCategory', [CategoryController::class, 'store']);

Route::get('category-attribute', [CategoryController::class, 'index_category_attribute']);
Route::post('updateCategoryAttribute', [CategoryController::class, 'store_category_attribute']);

//brand route
Route::get('brand', [BrandController::class, 'index']);
Route::post('updateBrand', [BrandController::class, 'store']);

//Tax route
Route::get('tax', [TaxController::class, 'index']);
Route::post('updateTax', [TaxController::class, 'store']);

//Product route
Route::get('product', [ProductController::class, 'index']);
Route::get('manage-product/{id?}', [ProductController::class, 'view_product']);
Route::post('updateProduct', [ProductController::class, 'store']);
Route::post('getAttributes', [ProductController::class, 'getAttributes']);


//delete Data
Route::get('deleteData/{id?}/{table?}', [DashboardController::class, 'deleteData']);
