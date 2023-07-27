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


Route::group(['prefix' => 'assessment-test', 'as' => 'assessment-test.', 'controller' => AssessmentTestController::class], function () {

    /*
    |--------------------------------------------------------------------------
    | Middleware Guest
    |--------------------------------------------------------------------------
    */
    Route::middleware(['guest'])->group(function () {
        Route::get('/authentication', 'participantAuthenticationPage')->name('participant-authentication-page');
        Route::post('/authentication', 'participantAuthentication')->name('participant-authentication');
    });

    /*
    |--------------------------------------------------------------------------
    | Middleware Auth Participant
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth.participant'])->group(function () {
        Route::get('/', 'assessmentTestPage')->name('assessment-test-page');
        Route::get('/welcome', 'welcomePage')->name('welcome-page');
        Route::get('/participant-page', 'participantPage')->name('participant-page');
        Route::post('/participant-prepare', 'prepareForAssessmentTest')->name('participant-prepare');
        Route::get('/participant-logout', 'logoutParticipant')->name('participant-logout');
    });

});

/*
|--------------------------------------------------------------------------
| Assessment Test Controller | Response JSON
|--------------------------------------------------------------------------
*/
Route::get('/get-assessment/from/{asmnt_group_uuid}', [AssessmentTestController::class, 'getAssessment'])->name('api.res.get-assessment');


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
