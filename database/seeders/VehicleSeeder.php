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
                'slug' => 'berline-affaires',
                'name' => 'Berline Affaires',
                'class' => 'sedan',
                'capacity_pax' => 3,
                'capacity_luggage' => 2,
                'base_rate' => 60.00,
                'per_km' => 1.50,
                'per_min' => 0.50,
                'is_active' => true,
                'description' => 'Mercedes Classe E, BMW Série 5 ou équivalent. Idéal pour vos déplacements professionnels et transferts aéroports.',
            ],
            [
                'slug' => 'berline-business',
                'name' => 'Berline Business',
                'class' => 'business',
                'capacity_pax' => 3,
                'capacity_luggage' => 3,
                'base_rate' => 80.00,
                'per_km' => 2.00,
                'per_min' => 0.70,
                'is_active' => true,
                'description' => 'Mercedes Classe S, BMW Série 7 ou équivalent. Le summum du confort et du prestige pour vos déplacements VIP.',
            ],
            [
                'slug' => 'van-familial',
                'name' => 'Van Familial',
                'class' => 'van',
                'capacity_pax' => 7,
                'capacity_luggage' => 8,
                'base_rate' => 100.00,
                'per_km' => 2.50,
                'per_min' => 0.80,
                'is_active' => true,
                'description' => 'Mercedes Classe V ou équivalent. Parfait pour les groupes et familles avec bagages volumineux.',
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
