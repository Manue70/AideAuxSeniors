<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ParametresFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_access_parametres()
    {
        $response = $this->get(route('parametres'));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_user_can_access_parametres()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('parametres'));
        $response->assertStatus(200);
    }
}
