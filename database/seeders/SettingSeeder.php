<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Company information
            'company_name' => 'VTC Paris Aéroport',
            'company_phone' => '+33 1 23 45 67 89',
            'company_email' => 'contact@vtcparis.fr',
            'company_whatsapp' => '+33 6 12 34 56 78',
            'company_address' => '123 Avenue des Champs-Élysées, 75008 Paris, France',

            // Pricing rules (JSON)
            'pricing_rules' => json_encode([
                'base_rates' => [
                    'sedan' => 60.00,
                    'business' => 80.00,
                    'van' => 100.00,
                ],
                'per_km' => [
                    'sedan' => 1.50,
                    'business' => 2.00,
                    'van' => 2.50,
                ],
                'per_minute' => [
                    'sedan' => 0.50,
                    'business' => 0.70,
                    'van' => 0.80,
                ],
                'minimum_fare' => 45.00,
                'airport_surcharge' => [
                    'cdg' => 15.00,
                    'ory' => 12.00,
                    'bva' => 20.00,
                ],
            ]),

            // Airport wait rules (JSON)
            'airport_wait_rules' => json_encode([
                'cdg' => [
                    'free_waiting' => 60, // minutes
                    'waiting_rate_per_minute' => 0.80,
                ],
                'ory' => [
                    'free_waiting' => 45,
                    'waiting_rate_per_minute' => 0.70,
                ],
                'bva' => [
                    'free_waiting' => 30,
                    'waiting_rate_per_minute' => 0.90,
                ],
            ]),

            // Site texts (JSON)
            'site_texts' => json_encode([
                'hero_title' => 'Service VTC Premium à Paris',
                'hero_subtitle' => 'Transferts CDG, Orly, Beauvais sans surprise',
                'booking_cta' => 'Calculer mon Tarif Fixe',
                'services_title' => 'Nos Services',
                'testimonials_title' => 'Avis Clients',
            ]),

            // Booking settings
            'booking_min_advance_hours' => 2,
            'booking_max_advance_days' => 90,
            'cancellation_policy_hours' => 24,

            // Payment settings
            'currency' => 'EUR',
            'payment_methods' => 'card,cash,bank_transfer',

            // Email settings
            'email_from_name' => 'VTC Paris Aéroport',
            'email_from_address' => 'noreply@vtcparis.fr',

            // Social media
            'facebook_url' => 'https://facebook.com/vtcparis',
            'instagram_url' => 'https://instagram.com/vtcparis',
            'linkedin_url' => 'https://linkedin.com/company/vtcparis',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $this->command->info('Settings seeded successfully!');
    }
}
