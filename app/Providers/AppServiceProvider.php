<?php

namespace App\Providers;

use App\Facades\Images\Image;
use App\Services\Auth\Login;
use App\Services\Auth\Logout;
use App\Services\CertificateConfig\CreateCertificate;
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
