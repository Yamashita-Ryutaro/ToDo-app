<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Folder\AdminFolderController;
/*
|--------------------------------------------------------------------------
| folder Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth', 'admin', 'verified'])->group(function () {
    Route::get('/admin/folders', [AdminFolderController::class, 'showFolderIndexPage'])->name('admin.folder.index');
    Route::get('/admin/folders/{folder_id}', [AdminFolderController::class, 'showFolderDetailPage'])->name('admin.folder.detail');
});