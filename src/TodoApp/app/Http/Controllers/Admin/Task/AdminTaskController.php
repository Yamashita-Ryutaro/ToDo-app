<?php

namespace App\Http\Controllers\Admin\Task;

use App\Http\Controllers\Controller;
use App\Services\Admin\Task\AdminTaskService;
use Illuminate\Http\Request;

class AdminTaskController extends Controller
{
    protected $adminTaskService;

    public function __construct(AdminTaskService $adminTaskService)
    {
        $this->adminTaskService = $adminTaskService;
    }

    /**
     * タスク一覧ページを表示
     *
     * @return \Illuminate\View\View
     */
    public function showTaskIndexPage()
    {
        // タスク一覧ページのデータを取得
        $tasks = $this->adminTaskService->showTaskIndexPageData();
        return view('admin.tasks.index', $tasks);
    }

    /**
     * タスク詳細ページを表示
     *
     * @param int $task_id
     * @return \Illuminate\View\View
     */
    public function showTaskDetailPage($task_id)
    {
        $task = $this->adminTaskService->showTaskDetailPageData($task_id);
        return view('admin.tasks.detail', $task);
    }
}