<?php

use App\Http\Controllers\Frontside\LandingpageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', [LandingpageController::class, 'index'])->name('index');
});


/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
