<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/


Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', [LoginController::class, 'login'])->name('auth.login');
});
