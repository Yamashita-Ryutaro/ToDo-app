<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\MstAdmin;

class MstAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $display_names = ['管理者', '一般'];
        foreach ($display_names as $display_name){
            MstAdmin::create([
                'display_name' => $display_name,
                // created_at/updated_atは自動でセットされる
            ]);
        }
    }
}
