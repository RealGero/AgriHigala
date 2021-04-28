<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\CustomerService;

class NewAnnouncement extends Notification
{
    use Queueable;
    public $announcement;

    public function __construct(CustomerService $announcement)
    {
        $this->announcement = $announcement;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'announcement' => $this->announcement
        ];
    }
    
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
