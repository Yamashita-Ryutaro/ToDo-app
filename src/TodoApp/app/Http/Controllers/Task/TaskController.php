<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Services\Task\TaskService;
use App\Http\Requests\Task\CreateTask;

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
}