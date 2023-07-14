<?php

namespace App\Providers;

use App\Services\Auth\Login;
use App\Services\Auth\Logout;
use App\Services\Users\CreateUser;
use App\Services\Users\FindUser;
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

    private function registerService($serviceName, $className) {
        $this->app->singleton($serviceName, function() use ($className) {
            return new $className;
        });
    }
}
