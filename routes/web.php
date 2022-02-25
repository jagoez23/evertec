<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\StatusUPController;
use App\Http\Controllers\ActiveUserController;
use App\Http\Controllers\MenuController;



Route::get('/', function () {
    return view('auth/login');
});

Route::apiResource('/user', UserController::class)->middleware('auth');

Route::apiResource('/product', ProductController::class)->middleware('auth');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/menu', [App\Http\Controllers\MenucController::class, 'index'])->name('menu');

Route::post('/statusproduct', [App\Http\Controllers\StatusUPController::class, 'status'])->name('statusproduct');

Route::post('/activeuser', [App\Http\Controllers\ActiveUserController::class, 'active'])->name('activeuser');





//rutas para la verificación del email
Route::get('/home', function () {
    return view('product');
})->middleware('auth','verified')->name('home');

Route::get('/product',
[App\Http\Controllers\ProductController::class, 'index'])->middleware('auth','verified')->name('product');

Route::get('/user', 
[App\Http\Controllers\UserController::class, 'index'])->middleware('auth','verified')->name('user');



Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/profile', function () {
    // Only verified users may access this route...
})->middleware('verified');

Auth::routes(['verify' => true]);
