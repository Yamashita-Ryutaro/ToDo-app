<?php

use Illuminate\Support\Facades\Route;
/* TaskControllerクラスを名前空間でインポートする */
use App\Http\Controllers\Task\TaskController;
/*
|--------------------------------------------------------------------------
| task Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get("/folders/{folder_id}/tasks", [TaskController::class,"showTaskTop"])->name("tasks.index");
    Route::get('/folders/{folder_id}/tasks/create', [TaskController::class,"showCreateTaskForm"])->name('tasks.create');
    Route::post('/folders/{folder_id}/tasks/create', [TaskController::class,"createTask"]);
    Route::get('/folders/{folder_id}/tasks/{task_id}/edit', [TaskController::class,"showEditTaskForm"])->name('tasks.edit');
    Route::post('/folders/{folder_id}/tasks/{task_id}/edit', [TaskController::class,"editTask"]);
    Route::get('/folders/{folder_id}/tasks/{task_id}/delete', [TaskController::class,"showDeleteTaskForm"])->name('tasks.delete');
    Route::post('/folders/{folder_id}/tasks/{task_id}/delete', [TaskController::class,"deleteTask"]);
});
