<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function register_page_is_accessible()
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);

        // Ici on vérifie un texte qui existe vraiment dans ta page
        $response->assertSee('Créer un compte');
    }
}
