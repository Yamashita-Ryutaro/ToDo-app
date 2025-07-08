<?php

namespace App\Services\Folder;

use App\Models\Folder;
use App\Models\Task\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FolderService
{
    /**
     * フォルダ編集ページの表示
     * 
     * @param Folder $folder
     * @return array $folder
     */
    public function showEditFolderFormDataById($folder)
    {
        return [ 'folder' => $folder ];
    }

    /**
     * フォルダ削除ページの表示
     * 
     * @param Folder $folder
     * @return array $folder
     */
    public function showDeleteFolderFormDataById($folder)
    {
        return [ 'folder' => $folder ];
    }

    /**
     * 新規フォルダ作成処理
     * 
     * @param array $validated_data
     * @return false|int id
     */
    public function createNewFolder($validated_data)
    {
        $result = false;
        DB::beginTransaction();
        try {
            $user_id = Auth::id();
            $title = $validated_data['title'];
            $folder = Folder::create([
                'title' => $title,
                'user_id' => $user_id,
            ]);
            $result = $folder->id;
            DB::commit();
        } catch (\Exception $e) {
            Log::error('新規フォルダ作成: ' . $e->getMessage());
            DB::rollBack();
        }
        return $result;
    }

    /**
     * フォルダの編集
     * 
     * @param Folder $folder
     * @param array $validated_data
     * @return bool $result
     */
    public function editFolder($folder, $validated_data)
    {
        $result = false;
        DB::beginTransaction();
        try {
            $folder->update([
                'title' => $validated_data['title']
            ]);
            DB::commit();
            $result = true;
        } catch (\Exception $e) {
            Log::error('フォルダ編集: ' . $e->getMessage());
            DB::rollBack();
        }
        return $result;
    }

    /**
     * フォルダの削除処理
     * 
     * @param Folder $folder
     * @return bool $result
     */
    public function deleteFolder($folder)
    {
        $result = false;
        DB::beginTransaction();
        try {
            $folder->tasks()->delete();
            $folder->delete();
            DB::commit();
            $result = true;
        } catch (\Exception $e) {
            Log::error('フォルダ削除: ' . $e->getMessage());
            DB::rollBack();
        }
        return $result;
    }

    /**
     * フォルダーモデルの検索
     * 
     * @param int $folder_id
     * @return Folder
     */
    public function getFolderById($folder_id)
    {
        return Folder::findOrFail($folder_id);
    }
}