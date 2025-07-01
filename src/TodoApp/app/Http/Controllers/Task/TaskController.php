<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Services\Task\TaskService;

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
}