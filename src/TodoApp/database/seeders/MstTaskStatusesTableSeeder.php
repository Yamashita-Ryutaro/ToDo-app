<?php

namespace Database\Seeders;

use App\Models\Task\MstTaskStatus;
use Illuminate\Database\Seeder;

class MstTaskStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = ['未着手', '着手中', '完了'];
        foreach ($statuses as $status){
            MstTaskStatus::create([
                'status' => $status,
                // created_at/updated_atは自動でセットされる
            ]);
        }
    }
}
