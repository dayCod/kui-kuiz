<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

class RoleBladeDirective extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('role', function (string $roles) {
            $roles_data = str_contains($roles, '|') ? explode('|', $roles) : array($roles);

            return in_array(Auth::user()->role, $roles_data);
        });
    }
}
