<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReminderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_create_reminder()
    {
        $response = $this->post(route('rappels.store'), [
            'message' => 'Prendre médicament',
            'type' => 'medicament',
            'heure' => ['08:00'],
        ]);

        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function user_can_create_reminder()
    {
        // Crée un utilisateur
        $user = User::factory()->create([
            'onboarding_completed' => true, // nécessaire pour accéder aux rappels
        ]);

        $this->actingAs($user);

        // Données valides pour le rappel
        $data = [
            'message' => 'Prendre médicament',
            'type' => 'medicament',
            'heure' => ['08:00'], // c'est un tableau comme requis par la validation
        ];

        $response = $this->post(route('rappels.store'), $data);

        // Vérifie que la redirection est vers la page des rappels
        $response->assertRedirect(route('rappels'));

        // Vérifie que le rappel est bien créé dans la base
        $this->assertDatabaseHas('reminders', [
            'message' => 'Prendre médicament',
            'user_id' => $user->id,
        ]);
    }
}

