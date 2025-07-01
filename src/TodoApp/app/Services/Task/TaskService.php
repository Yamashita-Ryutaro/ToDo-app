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
}