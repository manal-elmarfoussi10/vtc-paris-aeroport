<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;   // ✅ correct facade
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Optional: simple role gates if you want to keep them here
        Gate::define('admin', fn (User $user) => $user->role === 'admin');
        Gate::define('customer', fn (User $user) => $user->role === 'customer');
    }
}