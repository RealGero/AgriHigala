<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Order;

class NewOrder extends Notification{
    use Queueable;
    public $order;

    public function __construct(CustomerService $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'order' => $this->order
        ];
    }
    
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
