<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Reminder;

class ReminderCreated extends Notification
{
    use Queueable;

    public $reminder;

    public function __construct(Reminder $reminder)
    {
        $this->reminder = $reminder;
    }

    public function via($notifiable)
    {
        return ['database']; // ou ['mail', 'database'] selon ce que tu veux
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "Nouveau rappel créé : {$this->reminder->message} à {$this->reminder->heure}",
            'reminder_id' => $this->reminder->id,
        ];
    }
}
