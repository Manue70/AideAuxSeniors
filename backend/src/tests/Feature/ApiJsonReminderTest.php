<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiJsonReminderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_create_reminder_json()
    {
        $response = $this->postJson(route('rappels.store'), [
            'message' => 'Test',
            'type' => 'medicament',
            'heure' => ['08:00']
        ]);

        $response->assertStatus(401); // JSON API → pas connecté
    }

    /** @test */
    public function authenticated_user_can_create_reminder_json()
    {
        $user = User::factory()->create(['onboarding_completed' => true]);
        $this->actingAs($user);

        $data = [
            'message' => 'Test reminder',
            'type' => 'medicament',
            'heure' => ['08:00'],
        ];

        $response = $this->post(route('rappels.store'), $data);

        // Comme ton formulaire redirige
        $response->assertRedirect(route('rappels'));

        $this->assertDatabaseHas('reminders', [
            'message' => 'Test reminder',
            'user_id' => $user->id,
        ]);
    }
}
