<?php

namespace Database\Seeders;

use App\Models\Mail\SystemMail;
use Illuminate\Database\Seeder;

class SystemMailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        SystemMail::create([
            'subject' => 'パスワードリセットのご案内',
            'action_text' => 'パスワードをリセット',
            'system_mail_id' => 1,
            'body' => '以下のリンクをクリックしてパスワードをリセットしてください。',
        ]);
        SystemMail::create([
            'subject' => '仮登録メールのご案内',
            'action_text' => '仮登録を完了',
            'system_mail_id' => 2,
            'body' => '以下のリンクをクリックして仮登録を完了してください。',
        ]);
        SystemMail::create([
            'subject' => 'メール再設定のご案内',
            'action_text' => 'メールを再設定',
            'system_mail_id' => 3,
            'body' => '以下のリンクをクリックしてメールアドレスを再設定してください。',
        ]);
        SystemMail::create([
            'subject' => '今日のToDoリスト',
            'action_text' => '今日のタスクを確認',
            'system_mail_id' => 4,
            'body' => '{##TASK##}以下のリンクから今日のタスクを確認してください。',
        ]);
    }
}
