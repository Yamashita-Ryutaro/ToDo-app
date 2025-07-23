<?php

namespace App\Services\Admin\Mst;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\MstTables;
use App\Models\Admin\MstAdmin;
use App\Models\Task\MstTaskStatus;
use App\Models\Mail\MstSystemMail;
use App\Models\Notification\MstNotification;
use App\Models\Mail\MstSystemMailKey;

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
     * マスタテーブル詳細を更新
     *
     * @param array $validated_data
     * @param string $table_name
     * @return void
     */
    public function updateMstDetail($validated_data, $table_name)
    {
        $result = false;
        DB::beginTransaction();
        try {
            $model = $this->getTableModel($table_name);

            foreach ($validated_data['display_names'] as $id => $display_name) {
                $row = $model->find($id);
                if ($row) {
                    $row->display_name = $display_name;
                    $row->save();
                }
            }
            DB::commit();
            $result = true;
        } catch (\Exception $e) {
            Log::error('マスタテーブル更新: ' . $e->getMessage());
            DB::rollBack();
        }
        return [
            'result' => $result,
        ];
    }

    /**
     * 通知機能のマスタテーブル詳細を更新
     *
     * @param array $validated_data
     * @return array
     */
    public function updateNotificationMstDetail($validated_data)
    {
        $result = [
            'result' => false,
            'message' => null,
        ];
        try {
            DB::beginTransaction();
            $ids = array_keys($validated_data['display_names']);
            $notifications = MstNotification::whereIn('id', $ids)->get();

            foreach ($notifications as $row) {
                $row->display_name = $validated_data['display_names'][$row->id];
                $row->is_mandatory = $validated_data['is_mandatorys'][$row->id] ?? false;
                $row->save();
            }
            DB::commit();
            $result['result'] = true;
        } catch (\Exception $e) {
            Log::error('通知マスタテーブル更新: ' . $e->getMessage());
            DB::rollBack();
            $result['message'] = '通知マスタテーブルの更新に失敗しました';
        }
        return $result;
    }

    /**
     * システムメールキーのマスタテーブル詳細を更新
     *
     * @param array $validated_data
     * @return array
     */
    public function updateSystemMailKeyMstDetail($validated_data)
    {
        $result = [
            'result' => false,
            'message' => null,
        ];
        try {
            DB::beginTransaction();
            $ids = array_keys($validated_data['display_names']);
            $system_mail_keys = MstSystemMailKey::whereIn('id', $ids)->get();

            foreach ($system_mail_keys as $row) {
                $row->display_name = $validated_data['display_names'][$row->id];
                $row->key = $validated_data['keys'][$row->id] ?? false;
                $row->save();
            }
            DB::commit();
            $result['result'] = true;
        } catch (\Exception $e) {
            Log::error('システムメールキーのマスタテーブル更新: ' . $e->getMessage());
            DB::rollBack();
            $result['message'] = 'システムメールキーのマスタテーブルの更新に失敗しました';
        }
        return $result;
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
            case 'mst_notifications':
                // Assuming there's a model for notifications
                $contents = MstNotification::all();
                break;
            case 'mst_system_mail_keys':
                $contents = MstSystemMailKey::all();
                break;
            default:
                Log::error("Unsupported table name: {$table_name}");
                return null;
        }
        return $contents;
    }

    /**
     * 指定されたテーブルのモデルを取得
     * 
     * @param string $table_name
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    private function getTableModel($table_name)
    {
        switch ($table_name) {
            case 'mst_admin':
                return new MstAdmin();
            case 'mst_task_statuses':
                return new MstTaskStatus();
            case 'mst_system_mails':
                return new MstSystemMail();
            case 'mst_notifications':
                return new MstNotification();
            case 'mst_system_mail_keys':
                return new MstSystemMailKey();
            default:
                Log::error("Unsupported table name: {$table_name}");
                return null;
        }
    }
}