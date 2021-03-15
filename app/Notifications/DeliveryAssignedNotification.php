<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DeliveryAssignedNotification extends Notification
{
    use Queueable;

    protected $user;
    protected $deliveryId;
    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public function __construct($user,$deliveryId)
    {
        $this->user=$user;
        $this->deliveryId=$deliveryId;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message'=>'You have been assigned a new delivery task by '.$this->user,
            'delivery_id'=>$this->deliveryId,
            
        ];
    }
}
