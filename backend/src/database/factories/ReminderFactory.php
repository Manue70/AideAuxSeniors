<?php

namespace Database\Factories;

use App\Models\Reminder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReminderFactory extends Factory
{
    protected $model = Reminder::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'type' => $this->faker->randomElement(['medicament', 'boire']),
            'message' => $this->faker->sentence(),
            'heure' => $this->faker->time('H:i'),
            'est_effectue' => false,
            'is_daily' => $this->faker->boolean(),
        ];
    }
}
