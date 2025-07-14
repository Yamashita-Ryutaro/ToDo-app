<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Mst\AdminMstController;
/*
|--------------------------------------------------------------------------
| mst Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth', 'admin', 'verified'])->group(function () {
    Route::get('/admin/mst', [AdminMstController::class, 'showMstIndexPage'])->name('admin.mst.index');
    Route::get('/admin/mst/{table_name}', [AdminMstController::class, 'showMstDetailPage'])->name('admin.mst.detail');
    Route::put('/admin/mst/mst_notifications', [AdminMstController::class, 'updateNotificationMstDetail'])->name('admin.mst.notification.update');
    Route::put('/admin/mst/{table_name}', [AdminMstController::class, 'updateMstDetail'])->name('admin.mst.update');
});