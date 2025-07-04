<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Folder\FolderController;
/*
|--------------------------------------------------------------------------
| foler Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/folders/create', [FolderController::class, "showCreateForm"])->name('folders.create');
Route::post('/folders/create', [FolderController::class, "createNewFolder"]);
Route::get('/folders/{id}/edit', [FolderController::class,"showEditFolderForm"])->name('folders.edit');
Route::post('/folders/{id}/edit', [FolderController::class,"editFolder"]);