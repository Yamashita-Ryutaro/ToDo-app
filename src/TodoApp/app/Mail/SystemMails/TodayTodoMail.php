<?php

namespace App\Mail\SystemMails;

use App\Mail\SystemMailMail;
use Illuminate\Mail\Mailables\Content;

class TodayTodoMail extends SystemMailMail
{
    public $tasks;
    public function __construct($tasks)
    {
        parent::__construct(4);
        $this->url = route('home');
        $this->tasks = $tasks;

        // タスクを差し込む
        // 中間テーブルを作るため今はこのまま

        // 差し込みたい値の連想配列
        $replacements = [
            '{'.$this->url_key.'}' => $this->url,
        ];

        // bodyの置換
        $this->body = strtr($this->body, $replacements);
    }
}