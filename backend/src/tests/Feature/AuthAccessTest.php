<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthAccessTest extends TestCase
{
    public function test_guest_is_redirected_from_dashboard()
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_guest_is_redirected_from_rappels()
    {
        $response = $this->get('/rappels');
        $response->assertRedirect('/login');
    }
}
