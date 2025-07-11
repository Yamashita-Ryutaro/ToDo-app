<?php

namespace App\Services\Admin\Notification;

use App\Models\Notification\MstNotification;
use App\Models\Notification\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AdminNotificationService
{
    public function showNotificationIndexPageData()
    {
        $notifications = Notification::with('mstNotification')->get();
        return [
            'notifications' => $notifications,
        ];
    }

    public function showNotificationDetailPageData($id)
    {
        $notification = Notification::with('mstNotification')->find($id);
        return [
            'notification' => $notification,
        ];
    }

    public function updateNotification($validated_data, $id)
    {
        $result = [
            'result' => false,
            'message' => null,
        ];
        try {
            DB::beginTransaction();

            $notification = Notification::find($id);

            $notification->update($validated_data);

            DB::commit();
            $result['result'] = true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('通知更新: ' . $e->getMessage());
            $result['message'] = '通知の更新に失敗しました';
        }
        return $result;
    }
}