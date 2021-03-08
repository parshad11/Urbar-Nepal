<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DeliveryNotification extends Notification
{
    use Queueable;


    protected $user;
    public function __construct($user)
    {
        $this->user=$user;
    }


    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message'=>'You have been assigned a new task by '.$this->user,
        ];
    }
}
