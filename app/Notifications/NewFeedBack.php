<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\FeedBack;
class NewFeedBack extends Notification
{
    use Queueable;
    public $feedback;

    public function __construct(FeedBack $feedback)
    {
        $this->feedback = $feedback;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'announcement' => $this->feedback
        ];
    }
    
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
