<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Utilisateur Test 1',
                'email' => 'user1@example.com',
                'password' => Hash::make('password1234'),
                'is_admin' => false,
            ],
            [
                'name' => 'Utilisateur Test 2',
                'email' => 'user2@example.com',
                'password' => Hash::make('password1234'),
                'is_admin' => false,
            ],
        ];

        foreach ($users as $user) {
            if (!User::where('email', $user['email'])->exists()) {
                User::create($user);
            }
        }
    }
}
