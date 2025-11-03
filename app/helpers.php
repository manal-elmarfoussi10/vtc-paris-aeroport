<?php

if (!function_exists('setting')) {
    function setting($key, $default = null) {
        static $settings = null;

        if ($settings === null) {
            try {
                $settings = \Illuminate\Support\Facades\Cache::remember('app_settings', 3600, function () {
                    return \App\Models\Setting::pluck('value', 'key')->toArray();
                });
            } catch (\Exception $e) {
                $settings = [];
            }
        }

        return $settings[$key] ?? $default;
    }
}
