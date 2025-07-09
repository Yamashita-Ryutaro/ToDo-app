<?php

namespace App\Http\Controllers\Admin\Folder;

use App\Http\Controllers\Controller;
use App\Services\Admin\Folder\AdminFolderService;
use Illuminate\Http\Request;

class AdminFolderController extends Controller
{
    protected $adminFolderService;

    public function __construct(AdminFolderService $adminFolderService)
    {
        $this->adminFolderService = $adminFolderService;
    }

    /**
     * フォルダ一覧ページを表示
     *
     * @return \Illuminate\View\View
     */
    public function showFolderIndexPage()
    {
        $folders = $this->adminFolderService->showFolderIndexPageData();
        return view('admin.folders.index', $folders);
    }

    /**
     * フォルダ詳細ページを表示
     *
     * @param int $folder_id
     * @return \Illuminate\View\View
     */
    public function showFolderDetailPage($folder_id)
    {
        // フォルダ詳細ページのデータを取得
        $folder = $this->adminFolderService->showFolderDetailPageData($folder_id);
        
        // フォルダとタスクのデータをビューに渡す
        return view('admin.folders.detail', $folder);
    }
}
