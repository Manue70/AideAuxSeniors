<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function login_page_is_accessible()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Se connecter'); // optionnel, vérifie qu’un texte existe sur la page
    }
}
