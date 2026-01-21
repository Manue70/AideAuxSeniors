<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Appel des seeders pour remplir les tables
        $this->call([
            AdminSeeder::class,
            UsersSeeder::class,
        ]);
    }
}
