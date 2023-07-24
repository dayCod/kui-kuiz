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
use App\Services\QuestionAnswer\DeleteQuestionAnswer;
use App\Services\QuestionAnswer\UpdateQuestionAnswer;
use App\Services\Users\CreateUser;
use App\Services\Users\DeleteUser;
use App\Services\Users\FindUser;
use App\Services\Users\ForceDelete;
use App\Services\Users\GetTrashedUser;
use App\Services\Users\RestoreUser;
use App\Services\Users\UpdateUser;
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
        $this->registerService('Login', Login::class);
        $this->registerService('Logout', Logout::class);

        $this->registerService('FindUser', FindUser::class);
        $this->registerService('CreateUser', CreateUser::class);
        $this->registerService('UpdateUser', UpdateUser::class);
        $this->registerService('DeleteUser', DeleteUser::class);
        $this->registerService('GetTrashedUser', GetTrashedUser::class);
        $this->registerService('RestoreUser', RestoreUser::class);
        $this->registerService('ForceDelete', ForceDelete::class);

        $this->registerService('CreateCertificate', CreateCertificate::class);
        $this->registerService('FindCertificate', FindCertificate::class);
        $this->registerService('UpdateCertificate', UpdateCertificate::class);
        $this->registerService('DeleteCertificate', DeleteCertificate::class);

        $this->registerService('CreateAsmntGroup', CreateAsmntGroup::class);
        $this->registerService('UpdateAsmntGroup', UpdateAsmntGroup::class);
        $this->registerService('DeleteAsmntGroup', DeleteAsmntGroup::class);

        $this->registerService('CreateAssessment', CreateAssessment::class);
        $this->registerService('UpdateAssessment', UpdateAssessment::class);
        $this->registerService('DeleteAssessment', DeleteAssessment::class);

        $this->registerService('CreateQuestion', CreateQuestion::class);
        $this->registerService('UpdateQuestion', UpdateQuestion::class);
        $this->registerService('DeleteQuestion', DeleteQuestion::class);

        $this->registerService('CreateAnswer', CreateAnswer::class);
        $this->registerService('UpdateAnswer', UpdateAnswer::class);
        $this->registerService('DeleteAnswer', DeleteAnswer::class);

        $this->registerService('CreateQuestionAnswer', CreateQuestionAnswer::class);
        $this->registerService('UpdateQuestionAnswer', UpdateQuestionAnswer::class);
        $this->registerService('DeleteQuestionAnswer', DeleteQuestionAnswer::class);
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
