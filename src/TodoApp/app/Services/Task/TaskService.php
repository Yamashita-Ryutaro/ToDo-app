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
     * @param int $folder_id
     * @return array
     */
    public function showTaskTopPageData(int $folder_id)
    {
        $user_id = Auth::id();

        // ログインユーザーのフォルダのみ取得
        $folders = Folder::where('user_id', $user_id)->get();

        // 指定IDかつログインユーザーのフォルダのみ取得
        $folder = Folder::where('id', $folder_id)
                        ->where('user_id', $user_id)
                        ->firstOrFail();

        $tasks = $folder->tasks()->get();

        return [
            'folders' => $folders,
            'folder_id' => $folder_id,
            'tasks' => $tasks,
        ];
    }

    /**
     * タスク編集ページ表示
     * 
     * @param Task $task
     * @return array
     */
    public function showEditTaskFormDataById($task)
    {
        $task_status = TaskStatus::all();
        return [
            'task' => $task,
            'task_status' => $task_status,
        ];
    }

    /**
     * タスク削除ページ表示
     * 
     * @param Task $task
     * @return array
     */
    public function showDeleteTaskFormDataById($task)
    {
        $task_status = TaskStatus::all();
        return [
            'task' => $task,
            'task_status' => $task_status,
        ];
    }

    /**
     * 新規タスクの作成
     * 
     * @param Folder $folder
     * @param array $validated_data
     * @return bool
     */
    public function createTask($folder, $validated_data)
    {
        $result = false;
        DB::beginTransaction();
        try {
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
     * @param Task $task
     * @param array $validated_data
     * @return bool
     */
    public function editTask($task, $validated_data)
    {
        $result = false;
        DB::beginTransaction();
        try {
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
     * @param Task $task
     * @return bool
     */
    public function deleteTask($task)
    {
        $result = false;
        DB::beginTransaction();
        try {
            $task->delete();
            DB::commit();
            $result = true;
        } catch (\Exception $e) {
            Log::error('タスク削除: ' . $e->getMessage());
            DB::rollBack();
        }
        return $result;
    }

    /**
     * タスクモデルの取得
     * 
     * @param int $task_id
     * @return Task $task
     */
    public function getTaskById($task_id)
    {
        return Task::findOrFail($task_id);
    }
}