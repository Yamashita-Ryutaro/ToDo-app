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
     * @param int $notification_id
     * @return array
     */
    public function showNotificationDetailPageData($notification_id)
    {
        $notification = Notification::with('mstNotification')->find($notification_id);
        $mstNotifications = MstNotification::all();
        return [
            'notification' => $notification,
            'mstNotifications' => $mstNotifications,
        ];
    }

    /**
     * 通知作成ページのデータを取得
     *
     * @return array
     */
    public function showNotificationCreatePageData()
    {
        $notification = new Notification();
        $mstNotifications = MstNotification::all();
        return [
            'notification' => $notification,
            'mstNotifications' => $mstNotifications,
        ];
    }

    /**
     * 通知の作成
     *
     * @param array $validated_data
     * @return array
     */
    public function createNotification($validated_data)
    {
        $result = [
            'result' => false,
            'message' => null,
        ];
        try {
            DB::beginTransaction();
            $notification = new Notification();
            $notification->create(
                $validated_data,
            );
            DB::commit();
            $result['result'] = true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('通知作成: ' . $e->getMessage());
            $result['message'] = '通知の作成に失敗しました';
        }
        return $result;
    }

    /**
     * 通知の更新
     *
     * @param array $validated_data
     * @param int $notification_id
     * @return array
     */
    public function updateNotification($validated_data, $notification_id)
    {
        $result = [
            'result' => false,
            'message' => null,
        ];
        try {
            DB::beginTransaction();

            $notification = Notification::find($notification_id);

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
     * 通知の削除
     *
     * @param int $notification_id
     * @return array
     */
    public function deleteNotification($notification_id)
    {
        $result = [
            'result' => false,
            'message' => null,
        ];
        try {
            DB::beginTransaction();
            $notification = Notification::find($notification_id);
            $notification->delete();
            DB::commit();
            $result['result'] = true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('通知削除: ' . $e->getMessage());
            $result['message'] = '通知の削除に失敗しました';
        }
        return $result;
    }

    /**
     * 通知の送信
     *
     * @param int $notification_id
     * @return array
     */
    public function sentNotification($notification_id)
    {
        $result = [
            'result' => false,
            'message' => null,
        ];

        try {
            $user = User::all();
            $emails = $user->pluck('email')->toArray();
            Mail::to($emails)->send(new NotificationMail($notification_id));
            $result['result'] = true;
        } catch (\Exception $e) {
            Log::error('通知送信: ' . $e->getMessage());
            $result['message'] = '通知の送信に失敗しました';
        }

        return $result;
    }
}