<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // $this->registerPolicies();

        /**
         * -------------------------------------------
         * GATE ROLES
         * -------------------------------------------
         * 
         * Here are defined the gates, that act as 
         * roles, this way we can limit their permissions
         * 
         */

        Gate::define('admin', function (User $user) {
            return $user->tipo === 'admin';
        });

        Gate::define('boss', function (User $user) {
            return $user->tipo === 'jefe';
        });

        Gate::define('waiter', function(User $user){
            return $user->tipo === 'camarero';
        });

        Gate::define('cook', function(User $user){
            return $user->tipo === 'cocinero';
        });

        /**
         * -------------------------------------------
         * GATE PERMISSIONS
         * -------------------------------------------
         * 
         * Those gates, act as permissions, with those 
         * we can use de "can" command to show buttons 
         * for example
         * 
         */

        Gate::define('update.role', function (User $user){

        });

        Gate::define('create.company', function(User $user){

        });

    }
}
