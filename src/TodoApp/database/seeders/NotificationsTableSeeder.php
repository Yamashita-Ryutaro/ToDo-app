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
            'subject' => 'Sample Notification',
            'body' => 'This is a sample notification body.',
            'url_key' => 'sample-notification',
            'action_text' => 'View Notification',
            'notification_id' => 1,
        ]);
    }
}
