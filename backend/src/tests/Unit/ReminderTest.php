<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Reminder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReminderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_reminder()
    {
        $user = User::factory()->create();

        $reminder = Reminder::create([
            'user_id' => $user->id,
            'type' => 'medicament',
            'message' => 'Prendre un comprimé',
            'heure' => '08:00',
            'est_effectue' => false,
            'is_daily' => true,
        ]);

        $this->assertDatabaseHas('reminders', [
            'id' => $reminder->id,
            'message' => 'Prendre un comprimé',
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function it_can_toggle_est_effectue()
    {
        $user = User::factory()->create();

        $reminder = Reminder::factory()->create([
            'user_id' => $user->id,
            'est_effectue' => false
        ]);

        $reminder->est_effectue = !$reminder->est_effectue;
        $reminder->save();

        $this->assertTrue($reminder->fresh()->est_effectue);
    }
}
