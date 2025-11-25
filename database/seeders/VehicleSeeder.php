<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        Vehicle::truncate();

        Vehicle::create([
            'slug'             => 'eco-standard',
            'name'             => 'Gamme Eco',
            'class'            => 'eco',
            'capacity_pax'     => 3,
            'capacity_luggage' => 2,
            'base_rate'        => 35.00,   // 35€ minimum
            'per_km'           => 1.80,    // 1,80€/km
            'per_min'          => 0.00,
            'description'      => 'Gamme Eco 1,80€/km – 35€ minimum',
            'is_active'        => true,
            'sort_order'       => 1,
        ]);

        Vehicle::create([
            'slug'             => 'berline-business',
            'name'             => 'Gamme Berline & S Class',
            'class'            => 'berline',
            'capacity_pax'     => 3,
            'capacity_luggage' => 3,
            'base_rate'        => 55.00,   // 55€ minimum
            'per_km'           => 2.20,    // 2,20€/km
            'per_min'          => 0.00,
            'description'      => 'Gamme Berline et S Class 2,20€/km – 55€ minimum',
            'is_active'        => true,
            'sort_order'       => 2,
        ]);

        Vehicle::create([
            'slug'             => 'van-familial',
            'name'             => 'Gamme Van & V Class',
            'class'            => 'van',
            'capacity_pax'     => 7,
            'capacity_luggage' => 8,
            'base_rate'        => 65.00,   // 65€ minimum
            'per_km'           => 2.75,    // 2,75€/km
            'per_min'          => 0.00,
            'description'      => 'Vans haut de gamme pour familles et groupes.',
            'is_active'        => true,
            'sort_order'       => 3,
        ]);

        Vehicle::create([
            'slug'             => 'electric-premium',
            'name'             => 'Gamme Électrique',
            'class'            => 'electric',
            'capacity_pax'     => 3,
            'capacity_luggage' => 2,
            'base_rate'        => 50.00,   // 50€ minimum
            'per_km'           => 1.90,    // 1,90€/km
            'per_min'          => 0.00,
            'description'      => 'Gamme Électrique 1,90€/km – 50€ minimum',
            'is_active'        => true,
            'sort_order'       => 4,
        ]);

        $this->command->info('Vehicles seeded successfully!');
    }
}
