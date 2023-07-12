<?php

use App\Http\Controllers\Frontside\AssessmentTestController;
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
| Assessment Test Controller
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'assessment-test', 'as' => 'assessment-test.', 'middleware' => ['guest']], function () {

    Route::controller(AssessmentTestController::class)->group(function () {
        Route::get('/welcome', 'welcomePage')->name('welcome-page');
    });

});



/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Backside
|--------------------------------------------------------------------------
*/
require __DIR__ . '/backside.php';
