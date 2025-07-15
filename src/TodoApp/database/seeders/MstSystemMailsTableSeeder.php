<?php

namespace Database\Seeders;

use App\Models\Mail\MstSystemMail;
use Illuminate\Database\Seeder;

class MstSystemMailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        MstSystemMail::create([
            'display_name' => 'パスワードリセット',       
        ]);
        MstSystemMail::create([
            'display_name' => '仮登録メール',       
        ]);
        MstSystemMail::create([
            'display_name' => 'メール変更',       
        ]);
        MstSystemMail::create([
            'display_name' => '今日のToDoリスト',       
        ]);
    }
}
