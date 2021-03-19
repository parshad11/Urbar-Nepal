<?php

namespace App\Notifications;

use App\Delivery;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DeliveryAssignedNotification extends Notification
{
    use Queueable;

    protected $user;
    protected $delivery;
    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public function __construct($user,$delivery)
    {
        $this->user=$user;
        $this->delivery=$delivery;
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
	    $delivery=Delivery::find($this->delivery);
	    if($delivery->delivery_status=='received'){
        	return [
                'message'=>'You have been assigned a new delivery task by '.' '.$this->user,
                'delivery_id'=>$delivery->id,
            ];
        }
	    if($delivery->delivery_status=='cancelled'){
	    	return [
			    'message'=>'Your delivery task has been cancelled by'.' '.$this->user,
			    'delivery_id'=>$delivery->id,

		    ];
	    }
       
    }
}
