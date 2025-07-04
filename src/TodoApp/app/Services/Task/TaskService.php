<?php

namespace App\Services\Task;

use App\Models\Folder;
use App\Models\Task\Task;

class TaskService
{
    /**
     * タスク管理ページ表示
     * 
     * @param int $id
     * @return array
     */
    public function showTaskTopPageData(int $id)
    {
        $folders = Folder::all();

        $folder = Folder::find($id);

        $tasks = $folder->tasks()->get();

        return [
            'folders' => $folders,
            'folder_id' => $id,
            'tasks' => $tasks,
        ];
    }

    public function createTask($id, $validated_data)
    {
        $folder = Folder::find($id);
        $folder->tasks()->create([
            'title' => $validated_data['title'],
            'due_date' => $validated_data['due_date'],
        ]);

        return true;
    }
}