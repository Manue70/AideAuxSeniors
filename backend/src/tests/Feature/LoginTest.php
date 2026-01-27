<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_login_and_is_redirected_correctly()
    {
        // Crée un utilisateur avec onboarding terminé
        $user = User::factory()->create([
            'password' => bcrypt('password'),
            'onboarding_completed' => true,
        ]);

        // Login
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        // Redirection vers dashboard
        $response->assertRedirect(route('dashboard'));
    }

    /** @test */
    public function user_is_redirected_to_onboarding_if_not_completed()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
            'onboarding_completed' => false,
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        // Redirection vers la première page de l'onboarding
        $response->assertRedirect(route('onboarding.1'));
    }
}
