<?php

namespace App\Mail\SystemMails;

use App\Mail\SystemMailMail;

class UpdateProfileMail extends SystemMailMail
{
    public function __construct($token, $new_email)
    {
        parent::__construct(3);
        $this->url = route('user.profile.complete', [
            'user_token' => $token
        ]);

        // 差し込みたい値の連想配列
        $replacements = [
            $this->mail->url_key => $this->url,
            $this->mail->new_email_key => $new_email,
        ];

        // bodyの置換
        $this->mail->body = strtr($this->mail->body, $replacements);
    }
}
