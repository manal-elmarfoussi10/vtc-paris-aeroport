<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
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
        // Share settings globally
        View::composer('*', function ($view) {
            $settings = Cache::remember('app_settings', 3600, function () {
                return Setting::pluck('value', 'key')->toArray();
            });
            $view->with('settings', $settings);
        });

        // Register the setting() helper function
        if (!function_exists('setting')) {
            function setting($key, $default = null) {
                static $settings = null;

                if ($settings === null) {
                    $settings = Cache::remember('app_settings', 3600, function () {
                        return Setting::pluck('value', 'key')->toArray();
                    });
                }

                return $settings[$key] ?? $default;
            }
        }
    }
}
