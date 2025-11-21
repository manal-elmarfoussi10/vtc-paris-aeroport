<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            [
                'slug' => 'eco-range',
                'name' => 'Gamme Eco',
                'class' => 'eco',
                'capacity_pax' => 4,
                'capacity_luggage' => 2,
                'base_rate' => 35.00,
                'per_km' => 1.80,
                'per_min' => 0.50,
                'is_active' => true,
                'sort_order' => 1,
                'description' => 'Véhicules économiques pour déplacements quotidiens.',
            ],
            [
                'slug' => 'berline-s-class',
                'name' => 'Berline et S Class',
                'class' => 'sedan',
                'capacity_pax' => 3,
                'capacity_luggage' => 2,
                'base_rate' => 55.00,
                'per_km' => 2.20,
                'per_min' => 0.70,
                'is_active' => true,
                'sort_order' => 2,
                'description' => 'Mercedes Classe E, BMW Série 5 ou équivalent. Idéal pour vos déplacements professionnels et transferts aéroports.',
            ],
            [
                'slug' => 'van-v-class',
                'name' => 'Van et V Class',
                'class' => 'van',
                'capacity_pax' => 7,
                'capacity_luggage' => 8,
                'base_rate' => 65.00,
                'per_km' => 2.75,
                'per_min' => 0.80,
                'is_active' => true,
                'sort_order' => 3,
                'description' => 'Mercedes Classe V ou équivalent. Parfait pour les groupes et familles avec bagages volumineux.',
            ],
            [
                'slug' => 'electrique',
                'name' => 'Gamme Électrique',
                'class' => 'electric',
                'capacity_pax' => 4,
                'capacity_luggage' => 2,
                'base_rate' => 50.00,
                'per_km' => 1.90,
                'per_min' => 0.60,
                'is_active' => true,
                'sort_order' => 4,
                'description' => 'Véhicules électriques écologiques pour un transport durable.',
            ],
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::updateOrCreate(
                ['slug' => $vehicle['slug']],
                $vehicle
            );
        }

        $this->command->info('Vehicles seeded successfully!');
    }
}
