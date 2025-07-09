<?php

namespace App\Services\Admin\Task;

use App\Models\Task\Task;

class AdminTaskService
{
    /**
     * タスク一覧ページのデータを取得
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function showTaskIndexPageData()
    {
        // タスク一覧を取得
        $tasks = Task::all();
        // タスク一覧ページに必要なデータを整形して返す
        return [
            'tasks' => $tasks,
        ];
    }

    /**
     * タスク詳細ページのデータを取得
     *
     * @param int $task_id
     * @return \App\Models\Task|null
     */
    public function showTaskDetailPageData($task_id)
    {
        $task = Task::find($task_id);
        $folder = $task->folder;
        return [
            'task' => $task,
            'folder' => $folder,
        ];
    }   
}