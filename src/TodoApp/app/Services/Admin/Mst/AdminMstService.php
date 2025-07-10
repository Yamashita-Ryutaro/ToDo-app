<?php

namespace App\Services\Admin\Mst;

use Illuminate\Support\Facades\Log;
use App\Models\Admin\MstTables;
use App\Models\Admin\MstAdmin;
use App\Models\Task\MstTaskStatus;
use App\Models\Mail\MstSystemMail;

class AdminMstService
{
    /**
     * マスタテーブル一覧ページのデータを取得
     *
     * @return array
     */
    public function showMstIndexPageData()
    {
        $mstTables = MstTables::all();
        
        return [
            'tables' => $mstTables,
        ];
    }

    /**
     * マスタテーブル詳細ページのデータを取得
     *
     * @param string $table_name
     * @return array|null
     */
    public function showMstDetailPageData($table_name)
    {
        $table = MstTables::where('table_name', $table_name)->first();
        $contents = $this->getTableData($table_name);
        return [
            'table' => $table,
            'contents' => $contents,
        ];
    }

    /**
     * 指定されたテーブルのデータを取得
     *
     * @param string $table_name
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    private function getTableData($table_name)
    {
        switch ($table_name) {
            case 'mst_admin':
                $contents = MstAdmin::all();
                break;
            case 'mst_task_statuses':
                $contents = MstTaskStatus::all();
                break;
            case 'mst_system_mails':
                $contents = MstSystemMail::all();
                break;
            default:
                Log::error("Unsupported table name: {$table_name}");
                return null;
        }

        return $contents;
    }
}