<?php

namespace Database\Seeders;

use App\Models\Task\TaskStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskStatusesTableSeeder extends Seeder
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
            TaskStatus::create([
                'status' => $status,
                // created_at/updated_atは自動でセットされる
            ]);
        }
    }
}
