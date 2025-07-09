<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin\MstAdmin;
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
            MstTaskStatusesTableSeeder::class,
            MstTablesTableSeeder::class,
            UsersTableSeeder::class,
            FoldersTableSeeder::class,
            TasksTableSeeder::class,
        ]);
    }
}
