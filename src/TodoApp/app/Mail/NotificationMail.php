<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Notification\Notification;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $body;
    public $subject;
    public $url_key;
    public $url;

    public function __construct($notification_id)
    {
        $mail = Notification::find($notification_id);

        $this->body = $mail->body;
        $this->subject = $mail->subject;
        $this->url_key = $mail->url_key;
        $this->url = $mail->url;


        // 差し込みたい値の連想配列
        $replacements = [
            '{'.$this->url_key.'}' => $this->url,
        ];

        // bodyの置換
        $this->body = strtr($this->body, $replacements);
    }

    public function envelope()
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    public function content()
    {
        return new Content(
            view: 'mail.notification.1',
            with: [
                'body' => $this->body,
            ]
        );
    }

    public function attachments()
    {
        return [];
    }
}