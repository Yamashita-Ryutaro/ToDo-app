<?php

namespace Database\Seeders;

use App\Models\Task\Task;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 3) as $num) {
            Task::create([
                'folder_id' => 1,
                'title' => "サンプルタスク {$num}",
                'status_id' => $num,
                'due_date' => Carbon::now()->addDay($num - 1),
                // created_at/updated_at はEloquentが自動でセット
            ]);
        }
        Task::create([
            'folder_id' => 4,
            'title' => "サンプルタスク",
            'status_id' => 1,
            'due_date' => Carbon::now(),
        ]);
        Task::create([
            'folder_id' => 4,
            'title' => "サンプルタスク2",
            'status_id' => 1,
            'due_date' => Carbon::now(),
        ]);
    }
}
