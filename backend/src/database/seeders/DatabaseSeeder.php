<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // mot de passe admin
            'is_admin' => true,
            'onboarding_completed' => false,
        ]);

        // User 1
        User::create([
            'name' => 'User One',
            'email' => 'user1@example.com',
            'password' => Hash::make('password1234'), // mot de passe user1
            'is_admin' => false,
            'onboarding_completed' => false,
        ]);

        // User 2
        User::create([
            'name' => 'User Two',
            'email' => 'user2@example.com',
            'password' => Hash::make('password1234'), // mot de passe user2
            'is_admin' => false,
            'onboarding_completed' => false,
        ]);
    }
}

