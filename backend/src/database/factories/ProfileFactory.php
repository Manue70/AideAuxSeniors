<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition()
    {
        return [
            'user_id'       => User::factory(), 
            'prenom'        => $this->faker->firstName,
            'birthday'      => $this->faker->date(),
            'gender'        => $this->faker->randomElement(['male', 'female', 'other']),
            'theme_accueil' => $this->faker->word,
            'accessibilite' => $this->faker->sentence,
            'telephone'     => $this->faker->phoneNumber,
        ];
    }
}
