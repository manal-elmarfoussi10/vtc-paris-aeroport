<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Define authorization gates for roles
        Gate::define('isAdmin', fn (User $user) => $user->role === 'admin');
        Gate::define('isCustomer', fn (User $user) => $user->role === 'customer');

        // Backward compatibility gates
        Gate::define('admin', fn (User $user) => $user->role === 'admin');
        Gate::define('customer', fn (User $user) => $user->role === 'customer');

        // Register the setting helper function
        if (!function_exists('setting')) {
            function setting($key, $default = null) {
                return \App\Models\Setting::get($key, $default);
            }
        }
    }
}
