<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderCreatedNotification extends Notification
{
    use Queueable;
    protected $user;
	protected $transaction;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $transaction)
    {
        $this->user = $user;
		$this->transaction = $transaction;
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
            'message' => 'A new order has been made by contact' . ' ' . $this->user,
            'transaction_id' => $this->transaction->id,
        ];
    }
}
