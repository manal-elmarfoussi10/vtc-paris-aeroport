<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'slug' => 'transfert-aeroport',
                'name' => 'Transfert Aéroport',
                'subtitle' => 'CDG, Orly, Beauvais',
                'description' => 'Service de transfert privé vers et depuis les aéroports parisiens. Accueil personnalisé, suivi de vol en temps réel.',
                'icon' => 'plane',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'slug' => 'mise-a-disposition',
                'name' => 'Mise à disposition',
                'subtitle' => 'Location avec chauffeur',
                'description' => 'Location de véhicule avec chauffeur pour vos déplacements quotidiens ou occasionnels.',
                'icon' => 'clock',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'slug' => 'business',
                'name' => 'Business',
                'subtitle' => 'Transport d\'affaires',
                'description' => 'Service premium pour vos déplacements professionnels. Confort, discrétion et ponctualité garantis.',
                'icon' => 'briefcase',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'slug' => 'evenements',
                'name' => 'Événements',
                'subtitle' => 'Cérémonies et occasions spéciales',
                'description' => 'Transport élégant pour vos mariages, soirées, galas et autres événements importants.',
                'icon' => 'calendar',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['slug' => $service['slug']],
                $service
            );
        }

        $this->command->info('Services seeded successfully!');
    }
}
