<?php

namespace App\Services\Admin\Notification;

use App\Models\Notification\MstNotification;
use App\Models\Notification\Notification;
use App\Models\User;
use App\Mail\NotificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AdminNotificationService
{
    /**
     * 通知一覧ページのデータを取得
     *
     * @return array
     */
    public function showNotificationIndexPageData()
    {
        $notifications = Notification::with('mstNotification')->get();
        return [
            'notifications' => $notifications,
        ];
    }

    /**
     * 通知詳細ページのデータを取得
     *
     * @param int $id
     * @return array
     */
    public function showNotificationDetailPageData($id)
    {
        $notification = Notification::with('mstNotification')->find($id);
        $mstNotifications = MstNotification::all();
        return [
            'notification' => $notification,
            'mstNotifications' => $mstNotifications,
        ];
    }

    /**
     * 通知の更新
     *
     * @param array $validated_data
     * @param int $id
     * @return array
     */
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

    /**
     * 通知の送信
     *
     * @param int $id
     * @return array
     */
    public function sentNotification($id)
    {
        $result = [
            'result' => false,
            'message' => null,
        ];

        $user = User::all();
        $emails = $user->pluck('email')->toArray();
        Mail::to($emails)->send(new NotificationMail($id));

        // ここでは通知の送信処理を実装します。

        return $result;
    }
}