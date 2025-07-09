<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Services\Task\TaskService;
use App\Http\Requests\Task\CreateTask;
use App\Http\Requests\Task\EditTask;
use App\Services\Folder\FolderService;
use App\Models\Folder;

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
        $folder = $this->getAuthorizedFolder($folder_id, 'view');

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
        $folder = $this->getAuthorizedFolder($folder_id, 'view');

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
        $folder = $this->getAuthorizedFolder($folder_id, 'view');

        $task = $this->getAuthorizedTaskInFolder($task_id, $folder, 'view');

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
        $folder = $this->getAuthorizedFolder($folder_id, 'view');

        $task = $this->getAuthorizedTaskInFolder($task_id, $folder, 'view');

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
        $folder = $this->getAuthorizedFolder($folder_id, 'create');

        $validated_data = $request->validated();

        $result = $this->taskService->createTask($folder, $validated_data);

        if ($result) {
            return redirect()->route('tasks.index', ['folder_id' => $folder_id])->with('success', 'タスクの作成に成功');
        } else {
            return redirect()->back()->with('errors', 'タスクの作成に失敗');
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
        $folder = $this->getAuthorizedFolder($folder_id, 'update');

        $task = $this->getAuthorizedTaskInFolder($task_id, $folder, 'update');

        $validated_data = $request->validated();

        $result = $this->taskService->editTask($task, $validated_data);

        if ($result) {
            return redirect()->route('tasks.index', ['folder_id' => $folder_id,])->with('success', 'タスクの編集に成功');
        } else {
            return redirect()->back()->with('errors', 'タスクの編集に失敗');
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
        $folder = $this->getAuthorizedFolder($folder_id, 'delete');

        $task = $this->getAuthorizedTaskInFolder($task_id, $folder, 'delete');

        $result = $this->taskService->deleteTask($task);

        if ($result) {
            return redirect()->route('tasks.index', ['folder_id' => $folder_id,])->with('success', 'タスクの削除に成功');
        } else {
            return redirect()->back()->with('errors', 'タスクの削除に失敗');
        }
    }

    /**
     * 認可チェック
     * 
     * @param int $folder_id
     * @param string $ability
     * @return Folder $folder
     */
    private function getAuthorizedFolder(int $folder_id, string $ability)
    {
        $folder = $this->folderService->getFolderById($folder_id);
        $this->authorize($ability, $folder);
        return $folder;
    }

    /**
     * 認可チェック
     * 
     * @param int $task_id
     * @param Folder $folder
     * @param string $ability
     * @return Task $task
     */
    private function getAuthorizedTaskInFolder(int $task_id, $folder, string $ability)
    {
        $task = $this->taskService->gettaskById($task_id);
        $this->authorize($ability, $task);
        if (!$task->isInFolder($folder)) {
            // ここでabortやリダイレクトも可
            abort(403, 'This task does not belong to the folder.');
        }
        return $task;
    }
}