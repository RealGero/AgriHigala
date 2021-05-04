<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Stock;
class NewStock extends Notification
{
    use Queueable;
    public $stock;

    public function __construct(Stock $stock)
    {
        $this->stock = $stock;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'announcement' => $this->stock
        ];
    }
    
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
