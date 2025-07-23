<?php

namespace App\Mail\SystemMails;

use App\Mail\SystemMailMail;

class PreRegisterMail extends SystemMailMail
{
    public function __construct($token)
    {
        parent::__construct(2);
        $this->url = route('user.register.complete', [
            'user_token' => $token,
        ]);

        // 差し込みたい値の連想配列
        $replacements = [
            $this->mail->url_key => $this->url,
        ];

        // bodyの置換
        $this->mail->body = strtr($this->mail->body, $replacements);
    }
}