<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Define a gate for checking if the user is an admin
        Gate::define('isAdmin', function ($user) {
            return $user->isAdmin();
        });

        // Define a gate for checking if the user is an owner
        Gate::define('isOwner', function ($user) {
            return $user->isOwner();
        });

        // Define a gate for checking if the user is a customer
        Gate::define('isCustomer', function ($user) {
            return $user->isCustomer();
        });
    }
}

