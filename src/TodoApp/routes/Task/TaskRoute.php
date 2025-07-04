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

Route::get("/folders/{id}/tasks", [TaskController::class,"showTaskTop"])->name("tasks.index");
Route::get('/folders/{id}/tasks/create', [TaskController::class,"showCreateTaskForm"])->name('tasks.create');
Route::post('/folders/{id}/tasks/create', [TaskController::class,"create"]);