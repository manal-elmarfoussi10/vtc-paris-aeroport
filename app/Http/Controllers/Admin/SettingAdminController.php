<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingAdminController extends Controller
{
    public function index()
    {
        // Group settings by category for better organization
        $settings = Setting::orderBy('key')->get()->groupBy(function ($setting) {
            return explode('_', $setting->key)[0]; // Group by prefix
        });

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'nullable|string|max:255',
            'company_email' => 'nullable|email|max:255',
            'admin_password' => 'nullable|string|min:8|max:255',
            'pricing.*' => 'nullable|numeric|min:0',
        ]);

        try {
            // Update each setting
            foreach ($validated as $key => $value) {
                if ($key === 'admin_password' && !empty($value)) {
                    // Handle admin password change
                    $admin = \App\Models\User::where('role', 'admin')->first();
                    if ($admin) {
                        $admin->update(['password' => bcrypt($value)]);
                    }
                } elseif (str_starts_with($key, 'pricing_')) {
                    // Handle pricing settings
                    Setting::set($key, $value);
                } elseif ($value !== null) {
                    Setting::set($key, $value);
                }
            }

            // Clear cache to ensure fresh data
            Cache::forget('settings');

            return back()->with('success', 'Paramètres enregistrés avec succès.');

        } catch (\Exception $e) {
            return back()->withErrors(['general' => 'Erreur lors de la sauvegarde des paramètres.']);
        }
    }

    public function reset(Request $request)
    {
        $key = $request->input('key');

        if (!$key) {
            return back()->withErrors(['key' => 'Clé de paramètre requise.']);
        }

        // Get default value from seeder
        $defaults = [
            'company_name' => 'VTC Paris Aéroport',
            'company_email' => 'contact@vtcparisaeroport.fr',
            'booking_min_hours_ahead' => 2,
            'booking_max_days_ahead' => 90,
            'payment_enabled' => false,
        ];

        $defaultValue = $defaults[$key] ?? '';

        Setting::set($key, $defaultValue);
        Cache::forget('settings');

        return back()->with('success', "Paramètre '{$key}' remis à sa valeur par défaut.");
    }
}
