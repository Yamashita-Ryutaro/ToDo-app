<?php

namespace App\Services\Admin\Folder;

use App\Models\Folder;
use App\Models\Task\Task;

class AdminFolderService
{
    /**
     * フォルダ一覧ページのデータを取得
     *
     * @return \Illuminate\Database\Eloquent\Collection
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
     * @return \App\Models\Folder|null
     */
    public function showFolderDetailPageData($folder_id)
    {
        $folder = Folder::find($folder_id);
        $tasks = $folder->tasks;

        return [
            'folder' => $folder,
            'tasks' => $tasks,
        ];
    }
}