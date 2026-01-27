<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AssistanceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_access_assistance()
    {
        $response = $this->get(route('assistance'));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_user_can_access_assistance()
    {
        $user = User::factory()->create(['onboarding_completed' => true]);
        $this->actingAs($user);

        $response = $this->get(route('assistance'));
        $response->assertStatus(200);
    }
}
