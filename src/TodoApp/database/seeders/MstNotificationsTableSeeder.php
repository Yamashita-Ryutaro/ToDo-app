<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Notification\MstNotification;

class MstNotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MstNotification::create([
            'display_name' => '重要なお知らせ',
        ]);
        MstNotification::create([
            'display_name' => 'メンテナンス',
        ]);
        MstNotification::create([
            'display_name' => '新機能リリース',
        ]);
    }
}
