<?php

namespace App\Mail\SystemMails;

use App\Mail\SystemMailMail;

class PasswordResetMail extends SystemMailMail
{
    public function __construct($token)
    {
        parent::__construct(1);
        $this->url = route('password.reset', [
            'token' => $token,
        ]);

        // 差し込みたい値の連想配列
        $replacements = [
            $this->mail->url_key => $this->url,
        ];

        // bodyの置換
        $this->mail->body = strtr($this->mail->body, $replacements);
    }
}