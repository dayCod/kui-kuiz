<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', [LoginController::class, 'login'])->name('auth.login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('auth.authenticate');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', [LogoutController::class, 'logout'])->name('auth.logout');
});
