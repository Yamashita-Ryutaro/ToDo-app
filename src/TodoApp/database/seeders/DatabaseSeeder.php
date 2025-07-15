<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            MstAdminSeeder::class,
            MstSystemMailsTableSeeder::class,
            MstTaskStatusesTableSeeder::class,
            MstTablesTableSeeder::class,
            MstNotificationsTableSeeder::class,
            UsersTableSeeder::class,
            FoldersTableSeeder::class,
            TasksTableSeeder::class,
            SystemMailsTableSeeder::class,
            NotificationsTableSeeder::class,
            SystemMailKeySeeder::class,
        ]);
    }
}
