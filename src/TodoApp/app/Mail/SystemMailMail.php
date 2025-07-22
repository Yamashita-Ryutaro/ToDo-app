<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Mail\SystemMail;

class SystemMailMail extends Mailable
{
    use Queueable, SerializesModels;

    public $body;
    public $action_text;
    public $url_key;
    public $task_key;
    public $subject;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($system_mail_id, $url = null)
    {
        $mail = SystemMail::find($system_mail_id);

        $this->body = $mail->body;
        $this->action_text = $mail->action_text;
        $this->url_key = $mail->url_key;
        $this->task_key = $mail->task_key;
        $this->subject = $mail->subject;
        $this->url = $url;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mail.system_mails.system_mail',
            with: [
                'body' => $this->body,
                'action_text' => $this->action_text,
                'url' => $this->url,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}