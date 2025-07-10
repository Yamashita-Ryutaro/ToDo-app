<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Mail\SystemMail;

class PreRegisterNewUserNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $mail = SystemMail::where('system_mail_id', 2)->first();
        $url = route('password.reset', [
            'token' => $this->token,
        ]);


        // 差し込みたい値の連想配列
        $replacements = [
            '{'.$mail->url_key.'}' => $url, // たとえば $url = route('password.reset', ['token' => $token]);
        ];

        // bodyの置換
        $body = strtr($mail->body, $replacements);

        return (new MailMessage)
            ->subject($mail->subject)
            ->line($body)
            ->action($mail->action_text,  $url);
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
            //
        ];
    }
}
