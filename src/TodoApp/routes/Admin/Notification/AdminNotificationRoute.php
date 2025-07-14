<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Notification\AdminNotificationController;
/*
|--------------------------------------------------------------------------
| Notification Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth', 'admin', 'verified'])->group(function () {
    Route::get('/admin/notification', [AdminNotificationController::class, 'showNotificationIndexPage'])->name('admin.notification.index');
    Route::get('/admin/notification/create', [AdminNotificationController::class, 'showNotificationCreatePage'])->name('admin.notification.create.page');
    Route::post('/admin/notification/create', [AdminNotificationController::class, 'createNotification'])->name('admin.notification.create');
    Route::get('/admin/notification/{notification_id}', [AdminNotificationController::class, 'showNotificationDetailPage'])->name('admin.notification.detail');
    Route::put('/admin/notification/{notification_id}', [AdminNotificationController::class, 'updateNotification'])->name('admin.notification.update');
    Route::delete('/admin/notification/{notification_id}', [AdminNotificationController::class, 'deleteNotification'])->name('admin.notification.delete');
    Route::post('/admin/notification/{notification_id}', [AdminNotificationController::class, 'sentNotification'])->name('admin.notification.sent');
});