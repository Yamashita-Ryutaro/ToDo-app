<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\SystemMails\TodayTodoMail;

class SendTodayTodoMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:today-todo-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ユーザーに今日のToDoをメールで送信するコマンド';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = now()->toDateString();
        $nowHour = now()->hour;

        $users = User::where('notification_hour', $nowHour)
            ->whereHas('folders.tasks', function ($query) use ($today) {
                $query->whereDate('due_date', $today);
            })->get();

        foreach ($users as $user) {
            // 本日のタスク一覧を取得
            $tasks = $user->folders->flatMap(function ($folder) use ($today) {
                return $folder->tasks->where('due_date', $today);
            });
            Mail::to($user->email)->send(new TodayTodoMail($tasks));
        }

        $this->info('今日のタスクメール送信完了');
        return Command::SUCCESS;
    }
}
