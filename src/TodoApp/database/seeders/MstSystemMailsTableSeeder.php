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
    }
}
