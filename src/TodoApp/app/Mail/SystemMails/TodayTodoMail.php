<?php

namespace App\Mail\SystemMails;

use App\Mail\SystemMailMail;

class TodayTodoMail extends SystemMailMail
{
    public $tasks;
    public $task_key;

    public function __construct($tasks)
    {
        parent::__construct(4);
        $this->url = route('home');
        $this->tasks = $tasks;

        // タスクを差し込む
        // タスク一覧をHTML化
        $tasksHtml = '<ul>';
        foreach ($tasks as $task) {
            $tasksHtml .= '<li>' . e($task->title) . '</li>';
        }
        $tasksHtml .= '</ul>';

        // 差し込みたい値の連想配列
        $replacements = [
            '{'.$this->url_key.'}' => $this->url,
            '{'.$this->task_key.'}' => $tasksHtml,
        ];

        // bodyの置換
        $this->body = strtr($this->body, $replacements);
    }
}