<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Medication;
use App\Models\User;

class MedicationFactory extends Factory
{
    protected $model = Medication::class;

    public function definition(): array
    {
        return [
            'nom' => $this->faker->word(),            
            'dosage' => $this->faker->numberBetween(1, 500) . 'mg', 
            'user_id' => User::factory(),
            'is_daily' => $this->faker->boolean(),
            
        ];
    }
}
