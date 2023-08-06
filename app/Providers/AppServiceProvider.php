<?php

namespace App\Providers;

use App\Facades\Images\Image;
use App\Services\Answer\CreateAnswer;
use App\Services\Answer\DeleteAnswer;
use App\Services\Answer\UpdateAnswer;
use App\Services\AsmntGroup\CreateAsmntGroup;
use App\Services\AsmntGroup\DeleteAsmntGroup;
use App\Services\AsmntGroup\UpdateAsmntGroup;
use App\Services\Assessment\CreateAssessment;
use App\Services\Assessment\DeleteAssessment;
use App\Services\Assessment\UpdateAssessment;
use App\Services\Auth\Login;
use App\Services\Auth\Logout;
use App\Services\CertificateConfig\CreateCertificate;
use App\Services\CertificateConfig\DeleteCertificate;
use App\Services\CertificateConfig\FindCertificate;
use App\Services\CertificateConfig\UpdateCertificate;
use App\Services\Question\CreateQuestion;
use App\Services\Question\DeleteQuestion;
use App\Services\Question\UpdateQuestion;
use App\Services\QuestionAnswer\CreateQuestionAnswer;
use App\Services\QuestionAnswer\UpdateQuestionAnswer;
use App\Services\UserAssessmentTest\CreateUserAssessmentTest;
use App\Services\UserAssessmentTest\UpdateUserAssessmentTest;
use App\Services\Users\CreateUser;
use App\Services\Users\DeleteUser;
use App\Services\Users\FindUser;
use App\Services\Users\ForceDelete;
use App\Services\Users\GetTrashedUser;
use App\Services\Users\RestoreUser;
use App\Services\Users\UpdateUser;
use App\Services\Visitor\CreateVisitor;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /*
        |--------------------------------------------------------------------------
        | Login and Logout Services
        |--------------------------------------------------------------------------
        */
        $this->registerService('Login', Login::class);
        $this->registerService('Logout', Logout::class);

        /*
        |--------------------------------------------------------------------------
        | Users Services
        |--------------------------------------------------------------------------
        */
        $this->registerService('FindUser', FindUser::class);
        $this->registerService('CreateUser', CreateUser::class);
        $this->registerService('UpdateUser', UpdateUser::class);
        $this->registerService('DeleteUser', DeleteUser::class);
        $this->registerService('GetTrashedUser', GetTrashedUser::class);
        $this->registerService('RestoreUser', RestoreUser::class);
        $this->registerService('ForceDelete', ForceDelete::class);

        /*
        |--------------------------------------------------------------------------
        | Certificate Services
        |--------------------------------------------------------------------------
        */
        $this->registerService('CreateCertificate', CreateCertificate::class);
        $this->registerService('FindCertificate', FindCertificate::class);
        $this->registerService('UpdateCertificate', UpdateCertificate::class);
        $this->registerService('DeleteCertificate', DeleteCertificate::class);

        /*
        |--------------------------------------------------------------------------
        | Assessment Group Services
        |--------------------------------------------------------------------------
        */
        $this->registerService('CreateAsmntGroup', CreateAsmntGroup::class);
        $this->registerService('UpdateAsmntGroup', UpdateAsmntGroup::class);
        $this->registerService('DeleteAsmntGroup', DeleteAsmntGroup::class);

        /*
        |--------------------------------------------------------------------------
        | Assessment Services
        |--------------------------------------------------------------------------
        */
        $this->registerService('CreateAssessment', CreateAssessment::class);
        $this->registerService('UpdateAssessment', UpdateAssessment::class);
        $this->registerService('DeleteAssessment', DeleteAssessment::class);

        /*
        |--------------------------------------------------------------------------
        | Question Services
        |--------------------------------------------------------------------------
        */
        $this->registerService('CreateQuestion', CreateQuestion::class);
        $this->registerService('UpdateQuestion', UpdateQuestion::class);
        $this->registerService('DeleteQuestion', DeleteQuestion::class);

        /*
        |--------------------------------------------------------------------------
        | Answer Services
        |--------------------------------------------------------------------------
        */
        $this->registerService('CreateAnswer', CreateAnswer::class);
        $this->registerService('UpdateAnswer', UpdateAnswer::class);
        $this->registerService('DeleteAnswer', DeleteAnswer::class);

        /*
        |--------------------------------------------------------------------------
        | Question Answers Services
        |--------------------------------------------------------------------------
        */
        $this->registerService('CreateQuestionAnswer', CreateQuestionAnswer::class);
        $this->registerService('UpdateQuestionAnswer', UpdateQuestionAnswer::class);

        /*
        |--------------------------------------------------------------------------
        | User Assessment Test Services
        |--------------------------------------------------------------------------
        */
        $this->registerService('CreateUserAssessmentTest', CreateUserAssessmentTest::class);
        $this->registerService('UpdateUserAssessmentTest', UpdateUserAssessmentTest::class);

        /*
        |--------------------------------------------------------------------------
        | Visitor | Guest Services
        |--------------------------------------------------------------------------
        */
        $this->registerService('CreateVisitor', CreateVisitor::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Function for registering the exists services.
     *
     * @return void
     */
    private function registerService($serviceName, $className) {
        $this->app->singleton($serviceName, function() use ($className) {
            return new $className;
        });
    }
}
