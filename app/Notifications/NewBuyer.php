<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Buyer;
class NewBuyer extends Notification
{
    use Queueable;
    public $buyer;

    public function __construct(Buyer $buyer)
    {
        $this->buyer = $buyer;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'announcement' => $this->buyer
        ];
    }
    
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
