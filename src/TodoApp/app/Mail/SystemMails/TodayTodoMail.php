<?php

namespace App\Mail\SystemMails;

use App\Mail\SystemMailMail;

class TodayTodoMail extends SystemMailMail
{
    public function __construct($tasks)
    {
        parent::__construct(4);
        $this->url = route('home');

        // 1. フォルダごとにグループ化
        $folders = [];
        foreach ($tasks as $task) {
            // 例: folder_name がなければ「未分類」など
            $folderName = $task->folder->title ?? '未分類';
            $folders[$folderName][] = $task;
        }

        // 2. HTML化
        // タスクリスト部分テンプレートをレンダリング
        $tasksHtml = view('mail.system_mails.parts.task_list', [
            'folders' => $folders
        ])->render();

        // 差し込みたい値の連想配列
        $replacements = [
            $this->mail->url_key => $this->url,
            $this->mail->task_key => $tasksHtml,
        ];

        // bodyの置換
        $this->mail->body = strtr($this->mail->body, $replacements);
    }
}