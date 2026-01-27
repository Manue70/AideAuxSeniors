<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Reminder;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ReminderCreated;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReminderNotificationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function creating_reminder_sends_notification()
    {
        Notification::fake();

        $user = User::factory()->create(['onboarding_completed' => true]);
        $this->actingAs($user);

        $data = [
            'message' => 'Test notification',
            'type' => 'medicament',
            'heure' => ['08:00'],
        ];

        $this->post(route('rappels.store'), $data);

        Notification::assertSentTo(
            [$user],
            ReminderCreated::class
        );
    }
}


