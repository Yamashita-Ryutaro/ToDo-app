<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\Task\Task;

class TaskController extends Controller
{
    /**
     * タスク一覧機能の表示
     * 
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function index(int $id)
    {
        $folders = Folder::all();

        $folder = Folder::find($id);

        $tasks = $tasks = $folder->tasks()->get();

        return view('tasks/index', [
            'folders' => $folders,
            "folder_id" => $id,
            'tasks' => $tasks,
        ]);
    }
}