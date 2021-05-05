<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Rider;
class NewRider extends Notification
{
    use Queueable;
    public $rider;

    public function __construct(Rider $rider)
    {
        $this->rider = $rider;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'announcement' => $this->rider
        ];
    }
    
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
