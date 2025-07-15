<?php

namespace App\Mail\SystemMails;

use App\Mail\SystemMailMail;

class TodayTodoMail extends SystemMailMail
{
    public function __construct()
    {
        parent::__construct(4);
        $this->url = route('home');

        // 差し込みたい値の連想配列
        $replacements = [
            '{'.$this->url_key.'}' => $this->url,
        ];

        // bodyの置換
        $this->body = strtr($this->body, $replacements);
    }
}