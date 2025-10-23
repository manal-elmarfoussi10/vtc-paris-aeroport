<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Airport;

class AirportSeeder extends Seeder
{
    public function run(): void
    {
        $airports = [
            [
                'slug' => 'cdg',
                'code' => 'CDG',
                'name' => 'Aéroport Charles de Gaulle',
                'seo_title' => 'Transfert VTC Aéroport CDG Paris | Réservation en ligne',
                'seo_text' => 'Service de transfert VTC premium vers l\'aéroport Charles de Gaulle (CDG). Réservation 24h/24, chauffeur professionnel, véhicule climatisé. Tarifs fixes sans surprise.',
                'base_rate_to_paris' => 65.00,
                'is_active' => true,
            ],
            [
                'slug' => 'ory',
                'code' => 'ORY',
                'name' => 'Aéroport d\'Orly',
                'seo_title' => 'Transfert VTC Aéroport Orly Paris | Réservation en ligne',
                'seo_text' => 'Service de transfert VTC premium vers l\'aéroport d\'Orly (ORY). Réservation 24h/24, chauffeur professionnel, véhicule climatisé. Tarifs fixes sans surprise.',
                'base_rate_to_paris' => 45.00,
                'is_active' => true,
            ],
            [
                'slug' => 'bva',
                'code' => 'BVA',
                'name' => 'Aéroport Beauvais-Tillé',
                'seo_title' => 'Transfert VTC Aéroport Beauvais Paris | Réservation en ligne',
                'seo_text' => 'Service de transfert VTC premium vers l\'aéroport de Beauvais-Tillé (BVA). Réservation 24h/24, chauffeur professionnel, véhicule climatisé. Tarifs fixes sans surprise.',
                'base_rate_to_paris' => 95.00,
                'is_active' => true,
            ],
        ];

        foreach ($airports as $airport) {
            Airport::updateOrCreate(
                ['slug' => $airport['slug']],
                $airport
            );
        }

        $this->command->info('Airports seeded successfully!');
    }
}
