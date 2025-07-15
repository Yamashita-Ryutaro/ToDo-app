<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Folder;
use App\Models\User;

class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = ['プライベート', '仕事', '旅行'];
        $user = User::first();
        foreach ($titles as $title){
            Folder::create([
                'title' => $title,
                'user_id' => $user->id,
                // created_at/updated_atは自動でセットされる
            ]);
        }
        foreach ($titles as $title){
            Folder::create([
                'title' => $title,
                'user_id' => 2,
                // created_at/updated_atは自動でセットされる
            ]);
        }
    }
}
