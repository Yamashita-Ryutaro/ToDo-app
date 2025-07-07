<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Services\Task\TaskService;
use App\Http\Requests\Task\CreateTask;
use App\Http\Requests\Task\EditTask;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }
    
    /**
     * タスク一覧機能の表示
     * 
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function showTaskTop(int $id)
    {
        $result = $this->taskService->showTaskTopPageData($id);
        return view('tasks/index', $result);
    }

    /**
     *  【タスク作成ページの表示機能】
     *  
     *  GET /folders/{id}/tasks/create
     *  @param int $id
     *  @return \Illuminate\View\View
     */
    public function showCreateTaskForm(int $id)
    {
        return view('tasks/create', ['folder_id' => $id]);
    }

    /**
     *  【タスク編集ページの表示機能】
     *  機能：タスクIDをフォルダ編集ページに渡して表示する
     *  
     *  GET /folders/{id}/tasks/{task_id}/edit
     *  @param int $id
     *  @param int $task_id
     *  @return \Illuminate\View\View
     */
    public function showEditTaskForm(int $id, int $task_id)
    {
        $task = $this->taskService->showEditTaskFormDataById($task_id);
        return view('tasks/edit', $task);
    }

    /**
     *  【タスク削除ページの表示機能】
     *
     *  GET /folders/{id}/tasks/{task_id}/delete
     *  @param int $id
     *  @param int $task_id
     *  @return \Illuminate\View\View
     */
    public function showDeleteTaskForm(int $id, int $task_id)
    {
        $task = $this->taskService->showDeleteTaskFormDataById($task_id);
        return view('tasks/delete', $task);
    }

    /**
     *  【タスクの作成機能】
     *
     *  POST /folders/{id}/tasks/create
     *  @param int $id
     *  @param CreateTask $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function createTask(int $id, CreateTask $request)
    {
        $validated_data = $request->validated();

        $result = $this->taskService->createTask($id, $validated_data);

        if ($result) {
            return redirect()->route('tasks.index', ['id' => $id]);
        } else {
            return redirect()->back();
        }
    }

    /**
     *  【タスクの編集機能】
     *  機能：タスクが編集されたらDBを更新処理をしてタスク一覧にリダイレクトする
     *  
     *  POST /folders/{id}/tasks/{task_id}/edit
     *  @param int $id
     *  @param int $task_id
     *  @param EditTask $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function editTask(int $id, int $task_id, EditTask $request)
    {
        $validated_data = $request->validated();

        $result = $this->taskService->editTask($task_id, $validated_data);

        if ($result) {
            return redirect()->route('tasks.index', ['id' => $id,]);
        } else {
            return redirect()->back();
        }
    }

    /**
     *  【タスクの削除機能】
     *
     *  POST /folders/{id}/tasks/{task_id}/delete
     *  @param int $id
     *  @param int $task_id
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function deleteTask(int $id, int $task_id)
    {
        $result = $this->taskService->deleteTask($task_id);

        if ($result) {
            return redirect()->route('tasks.index', ['id' => $id,]);
        } else {
            return redirect()->back();
        }
    }
}