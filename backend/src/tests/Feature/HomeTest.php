<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function home_page_is_accessible_for_authenticated_user()
    {
        $user = User::factory()->create([
            'onboarding_completed' => true,
        ]);

        $this->actingAs($user);

        $response = $this->get('/dashboard'); // ou /home si c'est ta route
        $response->assertStatus(200);
    }
}
