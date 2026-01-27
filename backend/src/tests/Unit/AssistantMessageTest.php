<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\AssistantMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssistantMessageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_store_user_and_assistant_messages()
    {
        $userMessage = AssistantMessage::factory()->create(['role' => 'user']);
        $assistantMessage = AssistantMessage::factory()->create(['role' => 'assistant']);

        $this->assertDatabaseHas('assistant_messages', [
            'id' => $userMessage->id,
            'role' => 'user',
        ]);

        $this->assertDatabaseHas('assistant_messages', [
            'id' => $assistantMessage->id,
            'role' => 'assistant',
        ]);
    }

    /** @test */
    public function it_can_mark_message_as_sensitive()
    {
        $message = AssistantMessage::factory()->create(['is_sensitive' => true]);

        $this->assertTrue($message->is_sensitive);
    }
}
