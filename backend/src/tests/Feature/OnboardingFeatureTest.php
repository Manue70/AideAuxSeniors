<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OnboardingFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_access_onboarding()
    {
        $response = $this->get(route('onboarding.1'));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function user_with_onboarding_not_completed_can_access_all_onboarding_pages()
    {
        $user = User::factory()->create([
            'onboarding_completed' => false,
        ]);

        $this->actingAs($user);

        // Pages 1 à 5
        foreach (range(1, 5) as $step) {
            $response = $this->get(route("onboarding.$step"));
            $response->assertStatus(200);
        }
    }

    /** @test */
    public function user_with_onboarding_completed_is_redirected_to_dashboard()
    {
        $user = User::factory()->create([
            'onboarding_completed' => true,
        ]);

        $this->actingAs($user);

        // Même pour toutes les pages onboarding
        foreach (range(1, 5) as $step) {
            $response = $this->get(route("onboarding.$step"));
            $response->assertRedirect(route('dashboard'));
        }
    }

    /** @test */
    public function completing_onboarding_sets_flag_and_redirects()
    {
        $user = User::factory()->create([
            'onboarding_completed' => false,
        ]);

        $this->actingAs($user);

        $response = $this->post(route('onboarding.complete'));
        $response->assertRedirect(route('dashboard'));

        $this->assertTrue($user->fresh()->onboarding_completed);
    }
}

