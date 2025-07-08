<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Services\Task\TaskService;
use App\Http\Requests\Task\CreateTask;
use App\Http\Requests\Task\EditTask;
use App\Services\Folder\FolderService;

class TaskController extends Controller
{
    protected $taskService;
    protected $folderService;

    public function __construct(TaskService $taskService, FolderService $folderService)
    {
        $this->taskService = $taskService;
        $this->folderService = $folderService;
    }
    
    /**
     * タスク一覧機能の表示
     * 
     * @param int $folder_id
     * @return \Illuminate\View\View
     */
    public function showTaskTop(int $folder_id)
    {
        $folder = $this->folderService->getFolderById($folder_id);
        $this->authorize('view', $folder);

        $result = $this->taskService->showTaskTopPageData($folder_id);
        return view('tasks/index', $result);
    }

    /**
     *  【タスク作成ページの表示機能】
     *  
     *  GET /folders/{folder_id}/tasks/create
     *  @param int $folder_id
     *  @return \Illuminate\View\View
     */
    public function showCreateTaskForm(int $folder_id)
    {
        $folder = $this->folderService->getFolderById($folder_id);
        $this->authorize('view', $folder);

        return view('tasks/create', ['folder_id' => $folder_id]);
    }

    /**
     *  【タスク編集ページの表示機能】
     *  機能：タスクIDをフォルダ編集ページに渡して表示する
     *  
     *  GET /folders/{folder_id}/tasks/{task_id}/edit
     *  @param int $folder_id
     *  @param int $task_id
     *  @return \Illuminate\View\View
     */
    public function showEditTaskForm(int $folder_id, int $task_id)
    {
        $folder = $this->folderService->getFolderById($folder_id);
        $this->authorize('view', $folder);

        $task = $this->taskService->gettaskById($task_id);
        $this->authorize('view', $task);

        if (!$task->isInFolder($folder)) {
            return redirect()->route('home');
        }

        $data = $this->taskService->showEditTaskFormDataById($task);
        return view('tasks/edit', $data);
    }

    /**
     *  【タスク削除ページの表示機能】
     *
     *  GET /folders/{folder_id}/tasks/{task_id}/delete
     *  @param int $folder_id
     *  @param int $task_id
     *  @return \Illuminate\View\View
     */
    public function showDeleteTaskForm(int $folder_id, int $task_id)
    {
        $folder = $this->folderService->getFolderById($folder_id);
        $this->authorize('view', $folder);

        $task = $this->taskService->gettaskById($task_id);
        $this->authorize('view', $task);

        if (!$task->isInFolder($folder)) {
            return redirect()->route('home');
        }

        $data = $this->taskService->showDeleteTaskFormDataById($task);
        return view('tasks/delete', $data);
    }

    /**
     *  【タスクの作成機能】
     *
     *  POST /folders/{folder_id}/tasks/create
     *  @param int $folder_id
     *  @param CreateTask $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function createTask(int $folder_id, CreateTask $request)
    {
        $folder = $this->folderService->getFolderById($folder_id);
        $this->authorize('create', $folder);

        $validated_data = $request->validated();

        $result = $this->taskService->createTask($folder, $validated_data);

        if ($result) {
            return redirect()->route('tasks.index', ['folder_id' => $folder_id]);
        } else {
            return redirect()->back();
        }
    }

    /**
     *  【タスクの編集機能】
     *  機能：タスクが編集されたらDBを更新処理をしてタスク一覧にリダイレクトする
     *  
     *  POST /folders/{folder_id}/tasks/{task_id}/edit
     *  @param int $folder_id
     *  @param int $task_id
     *  @param EditTask $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function editTask(int $folder_id, int $task_id, EditTask $request)
    {
        $folder = $this->folderService->getFolderById($folder_id);
        $this->authorize('update', $folder);

        $task = $this->taskService->gettaskById($task_id);
        $this->authorize('update', $task);

        if (!$task->isInFolder($folder)) {
            return redirect()->route('home');
        }

        $validated_data = $request->validated();

        $result = $this->taskService->editTask($task, $validated_data);

        if ($result) {
            return redirect()->route('tasks.index', ['folder_id' => $folder_id,]);
        } else {
            return redirect()->back();
        }
    }

    /**
     *  【タスクの削除機能】
     *
     *  POST /folders/{folder_id}/tasks/{task_id}/delete
     *  @param int $folder_id
     *  @param int $task_id
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function deleteTask(int $folder_id, int $task_id)
    {
        $folder = $this->folderService->getFolderById($folder_id);
        $this->authorize('delete', $folder);

        $task = $this->taskService->gettaskById($task_id);
        $this->authorize('delete', $task);

        if (!$task->isInFolder($folder)) {
            return redirect()->route('home');
        }

        $result = $this->taskService->deleteTask($task);

        if ($result) {
            return redirect()->route('tasks.index', ['folder_id' => $folder_id,]);
        } else {
            return redirect()->back();
        }
    }
}