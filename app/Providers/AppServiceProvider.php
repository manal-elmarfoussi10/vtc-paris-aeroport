<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Define gates
        Gate::define('isAdmin', function ($user) {
            return $user->isAdmin();
        });

        // Share settings globally - only if table exists
        View::composer('*', function ($view) {
            try {
                $settings = Cache::remember('app_settings', 3600, function () {
                    return Setting::pluck('value', 'key')->toArray();
                });
                $view->with('settings', $settings);
            } catch (\Exception $e) {
                // If settings table doesn't exist yet, provide empty array
                $view->with('settings', []);
            }
        });


    }
}
