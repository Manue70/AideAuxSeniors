<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_logout()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->post('/logout'); // ou route('logout') si tu as nommée la route

        $response->assertRedirect('/login'); // ou la page que tu as après logout
        $this->assertGuest(); // vérifie que l'utilisateur n'est plus connecté
    }
}
