<?php

namespace Database\Factories;

use App\Models\AssistantMessage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssistantMessageFactory extends Factory
{
    protected $model = AssistantMessage::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'role' => $this->faker->randomElement(['user', 'assistant']),
            'content' => $this->faker->sentence(),
            'is_sensitive' => $this->faker->boolean(),
        ];
    }
}
