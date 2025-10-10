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
            ['email' => 'admin@vtc-paris.fr'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password123'), // change later
                'role' => 'admin',
            ]
        );
    }
}