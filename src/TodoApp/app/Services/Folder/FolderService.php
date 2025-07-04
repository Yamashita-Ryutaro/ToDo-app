<?php

namespace App\Services\Folder;

use App\Models\Folder;
use App\Models\Task\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FolderService
{
    /**
     * フォルダ編集ページの表示
     * 
     * @param int $id
     * @return array $folder
     */
    public function showEditFolderForm($id)
    {
        $folder = Folder::find($id);

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
            $title = $validated_data['title'];
            $folder = Folder::create(['title' => $title]);
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
     * @param int $id
     * @param array $validated_data
     * @return bool $result
     */
    public function editFolder($id, $validated_data)
    {
        $result = false;
        DB::beginTransaction();
        try {
            $folder = Folder::find($id);
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
}