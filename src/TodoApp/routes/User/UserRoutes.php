<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\UserController;
/* TaskControllerクラスを名前空間でインポートする */
/*
|--------------------------------------------------------------------------
| user Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get("/login", [UserController::class,"showLoginPage"])->name("user.login");
Route::get("/register", [UserController::class,"showRegisterPage"])->name("user.register");
Route::post("/register", [UserController::class,"registerNewUser"]);