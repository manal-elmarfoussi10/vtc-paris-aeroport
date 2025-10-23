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
            'company_phone' => 'nullable|string|max:20',
            'company_email' => 'nullable|email|max:255',
            'company_address' => 'nullable|string|max:500',
            'whatsapp' => 'nullable|string|max:20',
            'booking_min_hours_ahead' => 'nullable|integer|min:1|max:168',
            'booking_max_days_ahead' => 'nullable|integer|min:1|max:365',
            'pricing_rules_json' => 'nullable|json',
            'airport_wait_rules_json' => 'nullable|json',
            'site_texts_json' => 'nullable|json',
            'email_booking_confirmation' => 'nullable|string',
            'email_admin_notification' => 'nullable|string',
            'payment_enabled' => 'nullable|boolean',
            'payment_stripe_public_key' => 'nullable|string|max:255',
            'payment_stripe_secret_key' => 'nullable|string|max:255',
        ]);

        try {
            // Update each setting
            foreach ($validated as $key => $value) {
                if ($value !== null) {
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
            'company_phone' => '+33 1 23 45 67 89',
            'company_email' => 'contact@vtcparisaeroport.fr',
            'company_address' => '123 Avenue des Champs-Élysées, 75008 Paris, France',
            'whatsapp' => '+33 6 12 34 56 78',
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
