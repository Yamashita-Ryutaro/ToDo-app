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

    public function showNotificationIndexPage()
    {
        $notifications = $this->notificationService->showNotificationIndexPageData();
        return view('admin.notification.index', $notifications);
    }

    public function showNotificationDetailPage($id)
    {
        $notification = $this->notificationService->showNotificationDetailPageData($id);
        return view('admin.notification.detail', $notification);
    }

    public function createNotification(Request $request)
    {
        // Logic to create a new notification
    }

    public function updateNotification(UpdateAdminNotificationRequest $request, $id)
    {
        $validated_data = $request->validated();
        $result = $this->notificationService->updateNotification($validated_data, $id);

        if ($result['result']) {
            return redirect()->back()->with('success', '通知の更新に成功しました');
        }
        return redirect()->back()->with('error', $result['message'] ?? '通知の更新に失敗しました');
    }

    public function sentNotification(Request $request, $id)
    {
        // Logic to send the notification
    }
}
