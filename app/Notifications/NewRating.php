<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Rating;
class NewRating extends Notification
{
    use Queueable;
    public $rating;

    public function __construct(Rating $rating)
    {
        $this->rating = $rating;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'announcement' => $this->rating
        ];
    }
    
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
