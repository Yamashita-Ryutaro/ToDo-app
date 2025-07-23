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
            'subject' => 'サービス終了のお知らせ',
            'body' => 'をもってサービスを終了します。{##URL##}を確認してください。',
            'url_key' => '##URL##',
            'url' => 'home',
            'notification_id' => 1,
        ]);
        Notification::create([
            'subject' => '緊急メンテナンスのお知らせ',
            'body' => 'に緊急メンテナンスを行います。{##URL##}を確認してください。',
            'url_key' => '##URL##',
            'url' => 'home',
            'notification_id' => 1,
        ]);
        Notification::create([
            'subject' => 'メンテナンスのお知らせ',
            'body' => 'にシステムメンテナンスを行います。{##URL##}を確認してください。',
            'url_key' => '##URL##',
            'url' => 'home',
            'notification_id' => 2,
        ]);
        Notification::create([
            'subject' => '新機能リリースのお知らせ',
            'body' => 'に新機能をリリースしました。{##URL##}を確認してください。',
            'url_key' => '##URL##',
            'url' => 'home',
            'notification_id' => 3,
        ]);
    }
}
