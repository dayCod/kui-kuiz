<?php

use App\Http\Controllers\Backside\AssessmentInformation\AssessmentController;
use App\Http\Controllers\Backside\AssessmentInformation\AssessmentGroupController;
use App\Http\Controllers\Backside\AssessmentInformation\AssessmentQuestionController;
use App\Http\Controllers\Backside\Home\DashboardController;
use App\Http\Controllers\Backside\SettingInformation\ApplicationSettingController;
use App\Http\Controllers\Backside\SettingInformation\AssessmentSettingController;
use App\Http\Controllers\Backside\SettingInformation\CertificateSettingController;
use App\Http\Controllers\Backside\System\LogController;
use App\Http\Controllers\Backside\UserInformation\ParticipantController;
use App\Http\Controllers\Backside\UserInformation\SupervisorController;
use App\Http\Controllers\Backside\UserInformation\VisitorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backside Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'backside', 'middleware' => ['auth']], function () {

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
    | System Information
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'system', 'as' => 'system.', 'middleware' => ['role:admin']], function () {

        /*
        |--------------------------------------------------------------------------
        | Log Information
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix' => 'log', 'as' => 'log.'], function () {
            Route::get('/', [LogController::class, 'updatedLogInformationView'])->name('index');
            Route::get('/{log_id}/detail', [LogController::class, 'detailRelatedLogInformationView'])->name('detail');
        });

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
        Route::group(['prefix' => 'supervisor', 'as' => 'supervisor.', 'controller' => SupervisorController::class, 'middleware' => 'role:admin'], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/trash', 'trash')->name('trash');
            Route::get('/export', 'export')->name('export');
            Route::get('/{uuid}', 'show')->name('show');
            Route::get('/{uuid}/edit', 'edit')->name('edit');
            Route::put('/{uuid}/edit', 'update')->name('update');
            Route::delete('/{uuid}/destroy', 'destroy')->name('destroy');
            Route::get('/{uuid}/restore', 'restore')->name('restore');
            Route::delete('/{uuid}/force-delete', 'forceDelete')->name('force-delete');
        });

        /*
        |--------------------------------------------------------------------------
        | Participants
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix' => 'participant', 'as' => 'participant.', 'controller' => ParticipantController::class, 'middleware' => 'role:admin'], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/trash', 'trash')->name('trash');
            Route::get('/export', 'export')->name('export');
            Route::get('/{uuid}', 'show')->name('show');
            Route::get('/{uuid}/edit', 'edit')->name('edit');
            Route::put('/{uuid}/edit', 'update')->name('update');
            Route::delete('/{uuid}/destroy', 'destroy')->name('destroy');
            Route::get('/{uuid}/generate-certificate', 'generateAssessmentCertificate')->name('generate-certificate');
            Route::get('/{uuid}/assessment-history', 'assessmentHistory')->name('asessment-history');
            Route::get('/{uuid}/restore', 'restore')->name('restore');
            Route::delete('/{uuid}/force-delete', 'forceDelete')->name('force-delete');
        });

        /*
        |--------------------------------------------------------------------------
        | Visitor
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix' => 'visitor', 'as' => 'visitor.', 'controller' => VisitorController::class, 'middleware' => 'role:admin'], function () {
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

    /*
    |--------------------------------------------------------------------------
    | Assessment Information
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'assessment-information', 'as' => 'assessment-information.', 'middleware' => 'role:admin|supervisor'], function () {

        /*
        |--------------------------------------------------------------------------
        | Manage Assessment
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix' => 'manage-assessment', 'as' => 'manage-assessment.', 'controller' => AssessmentController::class], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/{uuid}/edit', 'edit')->name('edit');
            Route::put('/{uuid}/edit', 'update')->name('update');
            Route::delete('/{uuid}/destroy', 'destroy')->name('destroy');

            /*
            |--------------------------------------------------------------------------
            | Assessment Questions
            |--------------------------------------------------------------------------
            */
            Route::group(['prefix' => '{assessment_uuid}/question', 'as' => 'questions.', 'controller' => AssessmentQuestionController::class], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/create', 'store')->name('store');
                Route::get('/{question_uuid}', 'show')->name('show');
                Route::get('/{question_uuid}/edit', 'edit')->name('edit');
                Route::put('/{question_uuid}/edit', 'update')->name('update');
                Route::delete('/{question_uuid}/destroy', 'destroy')->name('destroy');
            });

        });

        /*
        |--------------------------------------------------------------------------
        | Assessment Group
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix' => 'assessment-group', 'as' => 'assessment-group.', 'controller' => AssessmentGroupController::class], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/{certificate_setting_uuid}', 'showCertificateConfig')->name('show-certificate-config');
            Route::get('/{uuid}/edit', 'edit')->name('edit');
            Route::put('/{uuid}/edit', 'update')->name('update');
            Route::delete('/{uuid}/destroy', 'destroy')->name('destroy');
        });

    });

    /*
    |--------------------------------------------------------------------------
    | Setting Information
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'setting-information', 'as' => 'setting-information.', 'middleware' => 'role:admin'], function () {

        /*
        |--------------------------------------------------------------------------
        | Assessment Setting
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix' => 'assessment-setting', 'as' => 'assessment-setting.', 'controller' => AssessmentSettingController::class], function () {
            Route::get('/', 'index')->name('index');
        });

        /*
        |--------------------------------------------------------------------------
        | Certificate Setting
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix' => 'certificate-setting', 'as' => 'certificate-setting.', 'controller' => CertificateSettingController::class], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/{uuid}', 'show')->name('show');
            Route::get('/{uuid}/edit', 'edit')->name('edit');
            Route::put('/{uuid}/edit', 'update')->name('update');
            Route::delete('/{uuid}/destroy', 'destroy')->name('destroy');
        });

        /*
        |--------------------------------------------------------------------------
        | Application Setting
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix' => 'application-setting', 'as' => 'application-setting.', 'controller' => ApplicationSettingController::class], function () {
            Route::get('/', 'index')->name('index');
        });

    });

});
