<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Mail\AdminMailController;
/*
|--------------------------------------------------------------------------
| mail Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/mail', [AdminMailController::class, 'showMailIndexPage'])->name('admin.mail.index');
    Route::get('/admin/mail/{id}', [AdminMailController::class, 'showMailDetailPage'])->name('admin.mail.detail');
});