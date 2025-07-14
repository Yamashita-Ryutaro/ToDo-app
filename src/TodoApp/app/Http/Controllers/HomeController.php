<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Services\Task\TaskService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     *  ホームページを表示するコントローラー
     *  
     *  GET /
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showHomePage(Request $request)
    {
        $user_id = Auth::id();
        
        // ログインユーザーのuser_idがFolderテーブルに存在するか判定
        $folder = Folder::where('user_id', $user_id)->first();

        $message = session()->only(['success', 'error', 'warning', 'info']);

        if ($folder) {
            return redirect()->route('tasks.index', ['folder_id' => $folder->id])->with($message);
        } else {
            return view('home')->with($message);
        }
    }
}
