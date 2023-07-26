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
Route::group([
    'prefix' => 'assessment-test',
    'as' => 'assessment-test.',
    'middleware' => ['guest'],
    'controller' => AssessmentTestController::class
], function () {
    Route::get('/authentication', 'participantAuthenticationPage')->name('participant-authentication-page');
    Route::post('/authentication', 'participantAuthentication')->name('participant-authentication');
});

Route::group([
    'prefix' => 'assessment-test',
    'as' => 'assessment-test.',
    'middleware' => ['auth.participant'],
    'controller' => AssessmentTestController::class
], function () {
    Route::get('/', 'assessmentTestPage')->name('assessment-test-page');
    Route::get('/welcome', 'welcomePage')->name('welcome-page');
    Route::get('/participant-page', 'participantPage')->name('participant-page');
});


/*
|--------------------------------------------------------------------------
| Assessment Test Controller | Response JSON
|--------------------------------------------------------------------------
*/
Route::controller(AssessmentTestController::class)->group(function () {
    Route::get('/get-assessment/from/{asmnt_group_uuid}', 'getAssessment')->name('api.res.get-assessment');
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
