<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Reminder;
use App\Notifications\ReminderCreated;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReminderCreatedNotificationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_sends_notification_when_reminder_created()
    {
        Notification::fake();

        $user = User::factory()->create();
        $reminder = Reminder::factory()->create(['user_id' => $user->id]);

        $user->notify(new ReminderCreated($reminder));

        Notification::assertSentTo($user, ReminderCreated::class, function ($notification) use ($reminder) {
            return $notification->reminder->id === $reminder->id;
        });
    }
}
