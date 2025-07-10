<?php

namespace App\Services\Admin\Folder;

use App\Models\Folder;
use App\Models\Task\Task;

class AdminFolderService
{
    /**
     * フォルダ一覧ページのデータを取得
     *
     * @return array
     */
    public function showFolderIndexPageData()
    {
        // フォルダ一覧を取得
        $folders = Folder::all();
        
        return [
            'folders' => $folders,
        ];
    }

    /**
     * フォルダ詳細ページのデータを取得
     *
     * @param int $folder_id
     * @return array
     */
    public function showFolderDetailPageData($folder_id)
    {
        $folder = Folder::with('tasks')->find($folder_id);

        return [
            'folder' => $folder,
            'tasks' => $folder->tasks,
        ];
    }
}