<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Mail\MstSystemMailKeyMailMap;

class MstSystemMailKeyMailMapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 全mst_system_mail_idを取得
        $mailIds = DB::table('mst_system_mails')->pluck('id');

        foreach ($mailIds as $mailId) {
            DB::table('mst_system_mail_key_mail_maps')->insert([
                'mst_system_mail_id' => $mailId,
                'mst_system_mail_key_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        MstSystemMailKeyMailMap::create([
            'mst_system_mail_id' => 4,
            'mst_system_mail_key_id' => 2,
        ]);
        MstSystemMailKeyMailMap::create([
            'mst_system_mail_id' => 3,
            'mst_system_mail_key_id' => 3,
        ]);
    }
}