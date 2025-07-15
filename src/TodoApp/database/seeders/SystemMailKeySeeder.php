<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mail\SystemMailKey;

class SystemMailKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SystemMailKey::create([
            'system_mails_id' => 1,
            'key' => '##URL##',
            'description' => 'パスワードリセット用のキー',
        ]);
        SystemMailKey::create([
            'system_mails_id' => 2,
            'key' => '##URL##',
            'description' => '仮登録用のキー',
        ]);
        SystemMailKey::create([
            'system_mails_id' => 3,
            'key' => '##URL##',
            'description' => 'メールアドレス再設定用のキー',
        ]);
        SystemMailKey::create([
            'system_mails_id' => 4,
            'key' => '##URL##',
            'description' => '今日のToDoリスト用のキー',
        ]);
        SystemMailKey::create([
            'system_mails_id' => 4,
            'key' => '##TASK##',
            'description' => '今日のToDoリスト表示用のキー',
        ]);
    }
}
