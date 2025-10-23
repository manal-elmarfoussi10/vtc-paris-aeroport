<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call all seeders in order
        $this->call([
            AdminUserSeeder::class,
            VehicleSeeder::class,
            SettingSeeder::class,
            AirportSeeder::class,
            ServiceSeeder::class,
        ]);

        // Create a test customer user
        User::factory()->create([
            'name' => 'Client Test',
            'email' => 'client@test.fr',
            'phone' => '+33 6 98 76 54 32',
            'role' => 'customer',
            'email_verified_at' => now(),
        ]);

        $this->command->info('Database seeded successfully!');
    }
}
