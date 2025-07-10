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
            'url_key' => '##PASSWORD_RESET##',
            'action_text' => 'パスワードをリセット',
            'system_mail_id' => 1,
            'body' => '以下のリンクをクリックしてパスワードをリセットしてください。',
        ]);
        SystemMail::create([
            'subject' => '仮登録メールのご案内',
            'url_key' => '##PRE_REGISTRATION##',
            'action_text' => '仮登録を完了',
            'system_mail_id' => 2,
            'body' => '以下のリンクをクリックして仮登録を完了してください。',
        ]);
    }
}
