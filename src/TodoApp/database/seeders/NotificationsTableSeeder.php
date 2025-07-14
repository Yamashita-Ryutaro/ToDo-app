<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Notification\Notification;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Notification::create([
            'subject' => 'メンテナンスのお知らせ',
            'body' => '{##DATE##}にシステムメンテナンスを行います。{##URL##}を確認してください。',
            'url_key' => '##URL##',
            'url' => 'home',
            'date_key' => '##DATE##',
            'date' => now()->addDays(3),
            'notification_id' => 1,
        ]);
    }
}
