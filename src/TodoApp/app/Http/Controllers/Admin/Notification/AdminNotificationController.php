<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\Notification\AdminNotificationService;
use App\Http\Requests\Admin\UpdateAdminNotificationRequest;

class AdminNotificationController extends Controller
{
    protected $notificationService;

    public function __construct(AdminNotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * 通知一覧ページを表示
     * 
     * @return \Illuminate\View\View
     */
    public function showNotificationIndexPage()
    {
        $notifications = $this->notificationService->showNotificationIndexPageData();
        return view('admin.notification.index', $notifications);
    }

    /**
     * 通知詳細ページを表示
     * 
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function showNotificationDetailPage($id)
    {
        $notification = $this->notificationService->showNotificationDetailPageData($id);
        return view('admin.notification.detail', $notification);
    }

    /**
     * 通知の作成
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createNotification(Request $request)
    {
        // Logic to create a new notification
    }

    /**
     * 通知の更新
     * 
     * @param \App\Http\Requests\Admin\UpdateAdminNotificationRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateNotification(UpdateAdminNotificationRequest $request, $id)
    {
        $validated_data = $request->validated();
        $result = $this->notificationService->updateNotification($validated_data, $id);

        if ($result['result']) {
            return redirect()->back()->with('success', '通知の更新に成功しました');
        }
        return redirect()->back()->with('error', $result['message'] ?? '通知の更新に失敗しました');
    }

    /**
     * 通知の送信
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sentNotification($id)
    {
        $result = $this->notificationService->sentNotification($id);

        if ($result['result']) {
            return redirect()->back()->with('success', '通知の送信に成功しました');
        }
        return redirect()->back()->with('error', $result['message'] ?? '通知の送信に失敗しました');
    }
}
