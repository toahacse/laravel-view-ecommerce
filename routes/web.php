<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\AuthorCollection;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Front\HomePageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
    // return redirect('admin/dashboard');
});

Route::get('/login', function () {
    return view('auth.signin');
});

Route::post('/login_user', [AuthController::class, 'loginUser']);
Route::get('/changeSlug', [HomePageController::class, 'changeSlug']);

Route::get('/logout', function () {
   Auth::logout();
   return redirect('/login');
});


Route::get('/{vue_capture?}', function () {
    return view('index');
})->where('vue_capture', '[\/\w\.-]*');

// Route::get('/createAdmin', [AuthController::class, 'createCustomer']);
