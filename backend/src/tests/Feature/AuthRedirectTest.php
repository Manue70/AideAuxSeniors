<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthRedirectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_is_redirected_to_admin_dashboard()
    {
        $admin = User::factory()->create([
            'is_admin' => true,
            'onboarding_completed' => false, 
        ]);

        $response = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password', 
        ]);

        $response->assertRedirect(route('admin'));
    }

    /** @test */
    public function user_not_onboarded_is_redirected_to_onboarding()
    {
        $user = User::factory()->create([
            'is_admin' => false,
            'onboarding_completed' => false,
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('onboarding.1'));
    }

    /** @test */
    public function user_with_onboarding_completed_can_access_dashboard()
    {
        $user = User::factory()->create([
            'is_admin' => false,
            'onboarding_completed' => true,
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('dashboard'));
    }
}
