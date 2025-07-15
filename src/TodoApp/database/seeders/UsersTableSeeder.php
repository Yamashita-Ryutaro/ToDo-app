<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * usersTable用テストデータ
     * 
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'test',
            'email' => 'dummy@sample.com',
            'is_get_notification' => true,
            'notification_hour' => Carbon::now()->hour,
            'password' => bcrypt('test1234'),
            'admin_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'email_verified_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'test2',
            'email' => 'dummy2@sample.com',
            'is_get_notification' => false,
            'password' => bcrypt('test1234'),
            'admin_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'email_verified_at' => Carbon::now(),
        ]);
    }
}