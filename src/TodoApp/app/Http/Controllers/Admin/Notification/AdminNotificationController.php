<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\Notification\AdminNotificationService;

class AdminNotificationController extends Controller
{
    protected $notificationService;

    public function __construct(AdminNotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function showNotificationIndexPage()
    {
        // Logic to show the notification index page
        return view('admin.notification.index');
    }

    public function showNotificationDetailPage($id)
    {
        // Logic to show the notification detail page
        return view('admin.notification.detail', ['id' => $id]);
    }

    public function createNotification(Request $request)
    {
        // Logic to create a new notification
    }

    public function updateNotification(Request $request, $id)
    {
        // Logic to update the notification
    }

    public function sentNotification(Request $request, $id)
    {
        // Logic to send the notification
    }
}
