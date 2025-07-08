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
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function showTaskTop(int $id)
    {
        $folder = $this->folderService->getFolderById($id);
        $this->authorize('view', $folder);

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
        $folder = $this->folderService->getFolderById($id);
        $this->authorize('view', $folder);

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
        $folder = $this->folderService->getFolderById($id);
        $this->authorize('view', $folder);

        $task = $this->taskService->gettaskById($task_id);
        $this->authorize('view', $task);

        $data = $this->taskService->showEditTaskFormDataById($task);
        return view('tasks/edit', $data);
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
        $folder = $this->folderService->getFolderById($id);
        $this->authorize('view', $folder);

        $task = $this->taskService->gettaskById($task_id);
        $this->authorize('view', $task);

        $data = $this->taskService->showDeleteTaskFormDataById($task);
        return view('tasks/delete', $data);
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
        $folder = $this->folderService->getFolderById($id);
        $this->authorize('create', $folder);

        $validated_data = $request->validated();

        $result = $this->taskService->createTask($folder, $validated_data);

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
        $folder = $this->folderService->getFolderById($id);
        $this->authorize('update', $folder);

        $task = $this->taskService->gettaskById($task_id);
        $this->authorize('update', $task);

        $validated_data = $request->validated();

        $result = $this->taskService->editTask($task, $validated_data);

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
        $folder = $this->folderService->getFolderById($id);
        $this->authorize('delete', $folder);

        $task = $this->taskService->gettaskById($task_id);
        $this->authorize('delete', $task);

        $result = $this->taskService->deleteTask($task);

        if ($result) {
            return redirect()->route('tasks.index', ['id' => $id,]);
        } else {
            return redirect()->back();
        }
    }
}