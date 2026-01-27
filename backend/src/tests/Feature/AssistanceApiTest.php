<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssistanceApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_send_message()
    {
        $response = $this->postJson(route('assistant'), [
            'message' => 'Bonjour',
        ]);

        $response->assertStatus(401); // non connecté
    }

    /** @test */
    public function authenticated_user_can_send_message()
    {
        $user = User::factory()->create(['onboarding_completed' => true]);
        $this->actingAs($user);

        $response = $this->postJson(route('assistant'), [
            'message' => 'Bonjour',
        ]);

        $response->assertStatus(200); 
        $response->assertJsonStructure(['reply']); 
    }
}
