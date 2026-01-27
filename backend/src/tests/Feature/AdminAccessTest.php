<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_access_admin()
    {
        $response = $this->get(route('admin'));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function non_admin_user_cannot_access_admin()
    {
        $user = User::factory()->create(['is_admin' => false]);
        $this->actingAs($user);

        $response = $this->get(route('admin'));
        $response->assertRedirect(route('home'));
    }

    /** @test */
    public function admin_user_can_access_admin()
    {
        $user = User::factory()->create(['is_admin' => true]);
        $this->actingAs($user);

        $response = $this->get(route('admin'));
        $response->assertStatus(200);
    }
}
