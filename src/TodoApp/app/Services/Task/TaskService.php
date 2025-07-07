<?php

namespace App\Services\Task;

use App\Models\Folder;
use App\Models\Task\Task;
use App\Models\Task\TaskStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $user_id = Auth::id();

        // ログインユーザーのフォルダのみ取得
        $folders = Folder::where('user_id', $user_id)->get();

        // 指定IDかつログインユーザーのフォルダのみ取得
        $folder = Folder::where('id', $id)
                        ->where('user_id', $user_id)
                        ->firstOrFail();

        $tasks = $folder->tasks()->get();

        return [
            'folders' => $folders,
            'folder_id' => $id,
            'tasks' => $tasks,
        ];
    }

    /**
     * タスク編集ページ表示
     * 
     * @param int $task_id
     * @return array
     */
    public function showEditTaskFormDataById(int $task_id)
    {
        $task = Task::find($task_id);
        $task_status = TaskStatus::all();
        return [
            'task' => $task,
            'task_status' => $task_status,
        ];
    }

    /**
     * タスク削除ページ表示
     * 
     * @param int $task_id
     * @return array
     */
    public function showDeleteTaskFormDataById($task_id)
    {
        $task = Task::find($task_id);
        $task_status = TaskStatus::all();
        return [
            'task' => $task,
            'task_status' => $task_status,
        ];
    }

    /**
     * 新規タスクの作成
     * 
     * @param int $id
     * @param array $validated_data
     * @return bool
     */
    public function createTask($id, $validated_data)
    {
        $result = false;
        DB::beginTransaction();
        try {
            $folder = Folder::find($id);
            $folder->tasks()->create([
                'title' => $validated_data['title'],
                'due_date' => $validated_data['due_date'],
            ]);
            DB::commit();
            $result = true;
        } catch (\Exception $e) {
            Log::error('新規タスク作成: ' . $e->getMessage());
            DB::rollBack();
        }
        return $result;
    }

    /**
     * タスクの編集
     * 
     * @param int $task_id
     * @param array $validated_data
     * @return bool
     */
    public function editTask($task_id, $validated_data)
    {
        $result = false;
        DB::beginTransaction();
        try {
            $task = Task::find($task_id);
            $task->update([
                'title' => $validated_data['title'],
                'status_id' => $validated_data['status'],
                'due_date' => $validated_data['due_date'],
            ]);
            DB::commit();
            $result = true;
        } catch (\Exception $e) {
            Log::error('タスク編集: ' . $e->getMessage());
            DB::rollBack();
        }
        return $result;
    }

    /**
     * タスク削除機能
     * 
     * @param int $task_id
     * @return bool
     */
    public function deleteTask($task_id)
    {
        $result = false;
        DB::beginTransaction();
        try {
            $task = Task::find($task_id);
            $task->delete();
            DB::commit();
            $result = true;
        } catch (\Exception $e) {
            Log::error('タスク削除: ' . $e->getMessage());
            DB::rollBack();
        }
        return $result;
    }
}