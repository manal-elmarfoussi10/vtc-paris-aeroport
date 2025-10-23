<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@vtcparis.fr'],
            [
                'name' => 'Administrateur VTC Paris',
                'phone' => '+33 1 23 45 67 89',
                'password' => Hash::make('Admin@2025!'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Admin user created: admin@vtcparis.fr / Admin@2025!');
    }
}
