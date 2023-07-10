<?php

use App\Http\Controllers\Backside\Home\DashboardController;
use App\Http\Controllers\Backside\UserInformation\ParticipantController;
use App\Http\Controllers\Backside\UserInformation\SupervisorController;
use App\Http\Controllers\Backside\UserInformation\VisitorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backside Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['guest']], function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
    });

    /*
    |--------------------------------------------------------------------------
    | User Information
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'user-information', 'as' => 'user-information.'], function () {

        /*
        |--------------------------------------------------------------------------
        | Supervisor
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix' => 'supervisor', 'as' => 'supervisor.', 'controller' => SupervisorController::class], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/trash', 'trash')->name('trash');
            Route::get('/{uuid}', 'show')->name('show');
            Route::get('/{uuid}/edit', 'edit')->name('edit');
            Route::put('/{uuid}/edit', 'update')->name('update');
            Route::delete('/{uuid}/destroy', 'destroy')->name('destroy');
        });

        /*
        |--------------------------------------------------------------------------
        | Participants
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix' => 'participant', 'as' => 'participant.', 'controller' => ParticipantController::class], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/trash', 'trash')->name('trash');
            Route::get('/{uuid}', 'show')->name('show');
            Route::get('/{uuid}/edit', 'edit')->name('edit');
            Route::put('/{uuid}/edit', 'update')->name('update');
            Route::delete('/{uuid}/destroy', 'destroy')->name('destroy');
            Route::get('{uuid}/assessment-history', 'assessmentHistory')->name('asessment-history');
        });

        /*
        |--------------------------------------------------------------------------
        | Visitor
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix' => 'visitor', 'as' => 'visitor.', 'controller' => VisitorController::class], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/trash', 'trash')->name('trash');
            Route::get('/{uuid}', 'show')->name('show');
            Route::get('/{uuid}/edit', 'edit')->name('edit');
            Route::put('/{uuid}/edit', 'update')->name('update');
            Route::delete('/{uuid}/destroy', 'destroy')->name('destroy');
        });

    });

});
