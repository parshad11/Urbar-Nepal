<?php

namespace App\Notifications;

use App\Utils\NotificationUtil;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class StaffAddedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notificationInfo)
    {
        $this->notificationInfo = $notificationInfo;
        $notificationUtil = new NotificationUtil();
        $notificationUtil->configureEmail($notificationInfo);
        $this->cc = !empty($notificationInfo['cc']) ? $notificationInfo['cc'] : null;
        $this->bcc = !empty($notificationInfo['bcc']) ? $notificationInfo['bcc'] : null;
        $this->attachment = !empty($notificationInfo['attachment']) ? $notificationInfo['attachment'] : null;
        $this->attachment_name = !empty($notificationInfo['attachment_name']) ? $notificationInfo['attachment_name'] : null;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $data = $this->notificationInfo;
        $mail = (new MailMessage)
                    ->subject($data['subject'])
                    ->view(
                        'emails.plain_html',
                        ['content' => $data['email_body']]
                    );
        if (!empty($this->cc)) {
            $mail->cc($this->cc);
        }
        if (!empty($this->bcc)) {
            $mail->bcc($this->bcc);
        }
        return $mail;
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
            'message'=>'Welcome to FreshKtm.',
        ];
    }
}
